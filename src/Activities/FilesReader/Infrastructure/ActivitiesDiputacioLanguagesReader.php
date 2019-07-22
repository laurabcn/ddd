<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Infrastructure;

use App\Activities\Activity\Application\Create\CreateActivityCommand;
use App\Activities\Activity\Domain\Repository\ActivityRepository;
use App\Activities\FilesReader\Domain\FilesReader;
use App\Activities\Provincia\Application\Create\CreateProvinciaCommand;
use App\Activities\Provincia\Domain\Repository\ProvinciaRepository;
use App\Activities\Site\Application\Create\CreateSiteCommand;
use App\Activities\Site\Domain\Repository\SiteRepository;
use App\Activities\Toolkit\IdGenerator\UuidGenerator;
use App\Shared\ValueObject\Id;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ActivitiesDiputacioLanguagesReader implements FilesReader
{
    /** @var GetActivitiesFromOpenData */
    private $getActivitiesFromOpenData;

    /** @var ProvinciaRepository */
    private $provinciaRepository;

    /** @var SiteRepository */
    private $siteRepository;

    /** @var ActivityRepository */
    private $activityRepository;

    /** @var CommandBus $commandBus */
    private $commandBus;

    public function __construct(
        GetActivitiesFromOpenData $getActivitiesFromOpenData,
        ProvinciaRepository $provinciaRepository,
        SiteRepository $siteRepository,
        ActivityRepository $sctivityRepository,
        CommandBus $commandBus
    ) {
        $this->getActivitiesFromOpenData = $getActivitiesFromOpenData;
        $this->provinciaRepository = $provinciaRepository;
        $this->siteRepository = $siteRepository;
        $this->activityRepository = $sctivityRepository;
        $this->commandBus = $commandBus;
    }

    public function read(string $language): void
    {
        $filestourism = $this->getActivitiesFromOpenData->execute($language);

        foreach ($filestourism as $file) {
            $idMunicipi = new Id(UuidGenerator::generateId());
            $idProvincia = !isset($file['rel_municipis']['grup_provincia']['provincia_codi']) ? '8' : $file['rel_municipis']['grup_provincia']['provincia_codi'];
            $nameMunicipi = !isset($file['rel_municipis']['municipi_nom']) ? null : $file['rel_municipis']['municipi_nom'];
            $nameProvincia = !isset($file['rel_municipis']['grup_provincia']['provincia_nom']) ? null : $file['rel_municipis']['grup_provincia']['provincia_nom'];

            $provincia = $this->provinciaRepository->byId(new Id($idProvincia));

            if (empty($provincia) && !empty($nameProvincia)) {
                /** @var string $nameProvincia */
                /** @var string $nameMunicipi */
                $commandProvincia = new CreateProvinciaCommand(
                    new Id(UuidGenerator::generateId()),
                    $idProvincia,
                    $nameProvincia,
                    $idMunicipi,
                    $nameMunicipi
                );
                $this->commandBus->handle($commandProvincia);
                $provincia = $this->provinciaRepository->byId(new Id($idProvincia));
            }

            if (!empty($nameMunicipi)) {
                /** @var string $nameMunicipi */
                $hasMunicipi = $provincia->hasMunicipi($nameMunicipi);
                if ($hasMunicipi) {
                    $provincia->registerMunicipi(
                       $idMunicipi,
                       $nameMunicipi
                   );
                    $this->provinciaRepository->save($provincia);
                }
            }

            $idSite = null;
            if (isset($file['grup_adreca'])) {
                $site = $this->siteRepository->bySite($file['grup_adreca']['adreca_nom']);

                if (null === $site) {
                    $commandSite = new CreateSiteCommand(
                        $idSite = new Id(UuidGenerator::generateId()),
                        $file['grup_adreca']['adreca_nom'],
                        $file['grup_adreca']['adreca'],
                        $file['grup_adreca']['codi_postal'],
                        $idMunicipi,
                        $file['grup_adreca']['localitzacio'],
                        null,
                        null,
                        null
                    );

                    $this->commandBus->handle($commandSite);
                } else {
                    $idSite = $site->id();
                }
            }

            $activity = $this->activityRepository->byCodeAndLanguage($file['acte_id'], $language);

            if (null === $activity) {
                $imatge = count($file['imatge']) > 0 ? $file['imatge'][0] : null;
                $tipus = count($file['tipus']) > 0 ? $file['tipus'][0] : null;
                $email = count($file['email']) > 0 ? $file['email'][0] : null;
                $phone = count($file['telefon_contacte']) > 0 ? $file['telefon_contacte'][0] : null;

                $commandActivity = new CreateActivityCommand(
                    new Id(UuidGenerator::generateId()),
                    $file['acte_id'],
                    $file['titol'],
                    $file['data_inici'],
                    $file['data_fi'],
                    $file['descripcio'],
                    $language,
                    $imatge,
                    $file['acte_url'],
                    $file['url_general'],
                    $email,
                    $phone,
                    $idSite,
                    $file['preu'],
                    $file['durada'],
                    $tipus,
                    $file['observacions'],
                    $file['aforament'],
                    $file['inscripcio']
                );
                $this->commandBus->handle($commandActivity);
            }
        }
    }
}
