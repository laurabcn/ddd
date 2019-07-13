<?php

namespace App\Activities\Infrastructure\FilesReader;

use App\Activities\Application\Activity\Create\CreateActivityCommand;
use App\Activities\Application\Provincia\Create\CreateProvinciaCommand;
use App\Activities\Application\Site\Create\CreateSiteCommand;
use App\Activities\Domain\Activity\Repository\ActivityRepository;
use App\Activities\Domain\FilesReader\FilesReader;
use App\Activities\Domain\Provincia\Municipi;
use App\Activities\Domain\Provincia\Repository\ProvinciaRepository;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Activities\Domain\Shared\ValueObject\Uuid;
use App\Activities\Domain\Site\Repository\SiteRepository;
use App\Activities\Infrastructure\FilesReader\GetActivitiesAjBcnFromOpenData;
use App\Activities\Toolkit\IdGenerator\UuidGenerator;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ActivitiesAjBCNReader implements FilesReader
{
    /** @var GetActivitiesFromOpenData */
    private $getActivitiesFromOpenData;

    /** @var GetActivitiesFromOpenDataLibraries */
    private $getActivitiesFromOpenDataLibraries;

    /** @var ProvinciaRepository  */
    private $provinciaRepository;

    /** @var SiteRepository  */
    private $siteRepository;

    /** @var ActivityRepository  */
    private $activityRepository;

    /** @var CommandBus $commandBus  */
    private $commandBus;

    private $getActivitiesFromOpenDataAjBcn;

    public function __construct(
        GetActivitiesAjBcnFromOpenData $getActivitiesFromOpenDataAjBcn,
        ProvinciaRepository $provinciaRepository,
        SiteRepository $siteRepository,
        ActivityRepository $sctivityRepository,
        CommandBus $commandBus
    )
    {
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
                    $nom = $file['lloc_simple']['nom'];
                    $site = $this->siteRepository->bySite($nom);

                    $code = '08';
                    $provincia = $this->provinciaRepository->byId($code);
                    $nameMunicipi =  ucfirst(strtolower($file['lloc_simple']['adreca_simple']['municipi']));
                    $municipi = new Municipi(new Id(UuidGenerator::generateId()), $nameMunicipi, $provincia->id());

                    if(null === $provincia) {
                        $commandProvincia = new CreateProvinciaCommand(
                            $idProvincia = new Id(UuidGenerator::generateId()),
                            $code,
                            $nameProvincia = 'Barcelona',
                            [$municipi->id()->id() => $municipi->name() ]
                        );
                        $this->commandBus->handle($commandProvincia);
                        $provincia = $this->provinciaRepository->byId($idProvincia);
                    }

                    if(null !== $nameMunicipi){
                        $hasMunicipi = $provincia->hasMunicipi($municipi->name());
                        if($hasMunicipi){
                            $provincia->registerMunicipi(
                                $municipi->id(),
                                $municipi->name()
                            );
                            $this->provinciaRepository->save($provincia);
                        }
                    }

                    if (null === $site && null !== isset($nom)) {
                        $commandSite = new CreateSiteCommand(
                            $idSite = new Id(UuidGenerator::generateId()),
                            $nom,
                            $file['lloc_simple']['adreca_simple']['carrer'] . ', ' . $file['lloc_simple']['adreca_simple']['numero'],
                            $file['lloc_simple']['adreca_simple']['codi_postal'],
                            $municipi->id(),
                            $file['lloc_simple']['adreca_simple']['municipi'],
                            null,
                            null,
                            null
                        );

                        $this->commandBus->handle($commandSite);
                    } else {
                        $idSite = $site->id()->id();
                    }

                    $commandActivity = new CreateActivityCommand(
                        new Id(UuidGenerator::generateId()),
                        $file['id'],
                        $file['nom'],
                        $file['data']['data_inici'],
                        $file['data']['data_fi'],
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

                $files = $this->getActivitiesFromOpenData->execute($language);
            }
        }
    }
}