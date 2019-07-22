<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure;

use App\Activities\Activity\Application\Create\CreateActivityCommand;
use App\Activities\Activity\Domain\Repository\ActivityRepository;
use App\Activities\FilesReader\Domain\FilesReader;
use App\Activities\Provincia\Application\Create\CreateProvinciaCommand;
use App\Activities\Provincia\Domain\Municipi;
use App\Activities\Provincia\Domain\Repository\ProvinciaRepository;
use App\Activities\Site\Application\Create\CreateSiteCommand;
use App\Activities\Site\Domain\Repository\SiteRepository;
use App\Activities\Toolkit\IdGenerator\UuidGenerator;
use App\Shared\ValueObject\Id;
use DateTime;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ActivitiesAjBCNReader implements FilesReader
{
    /** @var ProvinciaRepository */
    private $provinciaRepository;

    /** @var SiteRepository */
    private $siteRepository;

    /** @var ActivityRepository */
    private $activityRepository;

    /** @var CommandBus $commandBus */
    private $commandBus;

    private $getActivitiesFromOpenDataAjBcn;

    public function __construct(
        GetActivitiesAjBcnFromOpenData $getActivitiesFromOpenDataAjBcn,
        ProvinciaRepository $provinciaRepository,
        SiteRepository $siteRepository,
        ActivityRepository $sctivityRepository,
        CommandBus $commandBus
    ) {
        $this->getActivitiesFromOpenDataAjBcn = $getActivitiesFromOpenDataAjBcn;
        $this->provinciaRepository = $provinciaRepository;
        $this->siteRepository = $siteRepository;
        $this->activityRepository = $sctivityRepository;
        $this->commandBus = $commandBus;
    }

    public function read(string $language): void
    {
        $groups = $this->getActivitiesFromOpenDataAjBcn->execute();

        foreach ($groups as $group) {
            foreach ($group as $item) {
                foreach ($item as $file) {
                    if (is_array($file['data']['data_inici'])) {
                        continue;
                    }

                    $nom = $file['lloc_simple']['nom'];
                    $site = $this->siteRepository->bySite($nom);
                    $code = is_array($file['lloc_simple']['adreca_simple']['codi_postal']) ? '08' : substr($file['lloc_simple']['adreca_simple']['codi_postal'], 0, 4);
                    $nameMunicipi = ucfirst(strtolower($file['lloc_simple']['adreca_simple']['municipi']));
                    $municipi = new Municipi(new Id(UuidGenerator::generateId()), $nameMunicipi);

                    $provincia = $this->provinciaRepository->byName('barcelona');

                    if (is_null($provincia)) {
                        $commandProvincia = new CreateProvinciaCommand(
                            $idProvincia = new Id(UuidGenerator::generateId()),
                            $code,
                            $nameProvincia = 'Barcelona',
                            $municipi->id(),
                            $municipi->name()
                        );
                        $this->commandBus->handle($commandProvincia);
                        $provincia = $this->provinciaRepository->byId($idProvincia);
                    }

                    if (!is_null($nameMunicipi) && !$provincia->hasMunicipi($municipi->name())) {
                        $provincia->registerMunicipi(
                            $municipi->id(),
                            $municipi->name()
                        );
                        $this->provinciaRepository->save($provincia);
                    }

                    if (is_null($site) && !is_null($nom)) {
                        $commandSite = new CreateSiteCommand(
                            $idSite = new Id(UuidGenerator::generateId()),
                            $nom,
                            is_array($file['lloc_simple']['adreca_simple']['carrer']) ? null : $file['lloc_simple']['adreca_simple']['carrer'] . ', ' . $file['lloc_simple']['adreca_simple']['numero'],
                            $code,
                            $municipi->id(),
                            $file['lloc_simple']['adreca_simple']['municipi'],
                            null,
                            null,
                            null
                        );

                        $this->commandBus->handle($commandSite);
                    } else {
                        $idSite = $site->id();
                    }

                    $commandActivity = new CreateActivityCommand(
                        new Id(UuidGenerator::generateId()),
                        $file['id'],
                        $file['nom'],
                        (DateTime::createFromFormat('d/m/Y', $file['data']['data_inici']))->format('Y-m-d'),
                        is_array($file['data']['data_fi']) ? null : (DateTime::createFromFormat('d/m/Y', $file['data']['data_fi']))->format('Y-m-d'),
                        $language,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        $idSite,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null
                    );
                    $this->commandBus->handle($commandActivity);
                }
            }
        }
    }
}
