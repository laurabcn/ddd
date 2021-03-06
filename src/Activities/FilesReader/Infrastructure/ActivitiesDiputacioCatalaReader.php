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

class ActivitiesDiputacioCatalaReader implements FilesReader
{
    /** @var GetActivitiesFromOpenData */
    private $getActivitiesFromOpenData;

    /** @var GetActivitiesFromOpenDataLibraries */
    private $getActivitiesFromOpenDataLibraries;

    /** @var ProvinciaRepository */
    private $provinciaRepository;

    /** @var SiteRepository */
    private $siteRepository;

    /** @var ActivityRepository */
    private $activityRepository;

    /** @var CommandBus $commandBus */
    private $commandBus;
    private $getActivitiesFromOpenDataDiputacio;
    private $getActivitiesFromOpenDataMuseum;
    private $getActivitiesFromOpenDataParks;
    private $getActivitiesFromOpenDataSostenible;
    private $getActivitiesFromOpenDataTheater;

    public function __construct(
        GetActivitiesFromOpenData $getActivitiesFromOpenData,
        GetActivitiesFromOpenDataDiputacio $getActivitiesFromOpenDataDiputacio,
        GetActivitiesFromOpenDataLibraries $getActivitiesFromOpenDataLibraries,
        GetActivitiesFromOpenDataMuseum $getActivitiesFromOpenDataMuseum,
        GetActivitiesFromOpenDataParks $getActivitiesFromOpenDataParks,
        GetActivitiesFromOpenDataSostenible $getActivitiesFromOpenDataSostenible,
        GetActivitiesFromOpenDataTheater $getActivitiesFromOpenDataTheater,
        ProvinciaRepository $provinciaRepository,
        SiteRepository $siteRepository,
        ActivityRepository $sctivityRepository,
        CommandBus $commandBus
    ) {
        $this->getActivitiesFromOpenData = $getActivitiesFromOpenData;
        $this->getActivitiesFromOpenDataDiputacio = $getActivitiesFromOpenDataDiputacio;
        $this->getActivitiesFromOpenDataLibraries = $getActivitiesFromOpenDataLibraries;
        $this->getActivitiesFromOpenDataMuseum = $getActivitiesFromOpenDataMuseum;
        $this->getActivitiesFromOpenDataParks = $getActivitiesFromOpenDataParks;
        $this->getActivitiesFromOpenDataSostenible = $getActivitiesFromOpenDataSostenible;
        $this->getActivitiesFromOpenDataTheater = $getActivitiesFromOpenDataTheater;
        $this->provinciaRepository = $provinciaRepository;
        $this->siteRepository = $siteRepository;
        $this->activityRepository = $sctivityRepository;
        $this->commandBus = $commandBus;
    }

    public function read(string $language): void
    {
        $filesSostenible = $this->getActivitiesFromOpenDataSostenible->execute($language);

        foreach ($filesSostenible as $file) {
            $nom = $file['nom_del_lloc'];
            $site = $this->siteRepository->bySite($nom);

            if (null === $site && null !== isset($nom)) {
                $commandSite = new CreateSiteCommand(
                    $idSite = new Id(UuidGenerator::generateId()),
                    $nom,
                    null,
                    null,
                    null,
                    $file['localitzacio'],
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
                $file['categories'],
                $file['data_inicial'],
                $file['data_final'],
                $language,
                $file['cos'],
                $file['imatge'],
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

        $filesDiputacio = $this->getActivitiesFromOpenDataDiputacio->execute($language);
        $filesTheater = $this->getActivitiesFromOpenDataTheater->execute($language);
        $filesMuseum = $this->getActivitiesFromOpenDataMuseum->execute($language);
        $fileslibrary = $this->getActivitiesFromOpenDataLibraries->execute($language);
        $filesParks = $this->getActivitiesFromOpenDataParks->execute($language);
        $filestourism = $this->getActivitiesFromOpenData->execute($language);

        $files = array_merge($filesDiputacio, $fileslibrary, $filesMuseum, $filesParks, $filesTheater, $filestourism);

        foreach ($files as $file) {
            $idMunicipi = new Id(UuidGenerator::generateId());
            $code = !isset($file['rel_municipis']['grup_provincia']['provincia_codi']) ? '08' : $file['rel_municipis']['grup_provincia']['provincia_codi'];
            $nameMunicipi = !isset($file['rel_municipis']['municipi_nom']) ? null : $file['rel_municipis']['municipi_nom'];
            $nameProvincia = isset($file['rel_municipis']['grup_provincia']['provincia_nom']) ? $file['rel_municipis']['grup_provincia']['provincia_nom'] : null;

            if (!empty($nameProvincia) && !empty($nameMunicipi)) {
                /** @var string $nameProvincia */
                $provincia = $this->provinciaRepository->byName($nameProvincia);

                if (is_null($provincia)) {
                    /** @var string $nameMunicipi */
                    $commandProvincia = new CreateProvinciaCommand(
                        $idProvincia = new Id(UuidGenerator::generateId()),
                        $code,
                        $nameProvincia,
                        $idMunicipi,
                        $nameMunicipi
                    );
                    $this->commandBus->handle($commandProvincia);
                    $provincia = $this->provinciaRepository->byId($idProvincia);
                }
                if ($provincia->hasMunicipi($nameMunicipi)) {
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

            $activity = $this->activityRepository->byCode($file['acte_id']);

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
                    $language,
                    $file['descripcio'],
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
