<?php

namespace App\Activities\Infrastructure\FilesReader;

use App\Activities\Application\Activity\Create\CreateActivityCommand;
use App\Activities\Application\Provincia\Create\CreateProvinciaCommand;
use App\Activities\Application\Site\Create\CreateSiteCommand;
use App\Activities\Domain\Activity\Repository\ActivityRepository;
use App\Activities\Domain\FilesReader\FilesReader;
use App\Activities\Domain\Provincia\Repository\ProvinciaRepository;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Activities\Domain\Site\Repository\SiteRepository;
use App\Activities\Toolkit\IdGenerator\UuidGenerator;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ActivitiesGeneralitatCatalaReader implements FilesReader
{
    /** @var GetActivitiesFromSocrata */
    private $getActivitiesFromSocrata;

    /** @var ProvinciaRepository  */
    private $provinciaRepository;

    /** @var SiteRepository  */
    private $siteRepository;

    /** @var ActivityRepository  */
    private $activityRepository;

    /** @var CommandBus $commandBus  */
    private $commandBus;

    public function __construct(
        GetActivitiesFromSocrata $getActivitiesFromSocrata,
        ProvinciaRepository $provinciaRepository,
        SiteRepository $siteRepository,
        ActivityRepository $sctivityRepository,
        CommandBus $commandBus
    )
    {
        $this->getActivitiesFromSocrata = $getActivitiesFromSocrata;
        $this->provinciaRepository = $provinciaRepository;
        $this->siteRepository = $siteRepository;
        $this->activityRepository = $sctivityRepository;
        $this->commandBus = $commandBus;
    }

    public function read(string $language): void
    {
        $files = $this->getActivitiesFromSocrata->execute();

        foreach ($files as $file) {
            $comarca = explode('/', $file['comarca_i_municipi']);
            $idMunicipi = UuidGenerator::generateId();
            $idProvincia = !isset( $file['rel_municipis']['grup_provincia']['provincia_codi']) ? '8' : $file['rel_municipis']['grup_provincia']['provincia_codi'];
            $nameMunicipi = !isset($comarca[3]) ? null : $comarca[3];
            $nameProvincia = !isset( $comarca[1]) ? null : $comarca[1];

            $provincia = $this->provinciaRepository->byName($nameProvincia);

             if(null === $provincia && null !== $nameProvincia ) {
                $commandProvincia = new CreateProvinciaCommand(
                    $idProvincia,
                    $nameProvincia,
                    [$idMunicipi => $nameMunicipi]
                );
                $this->commandBus->handle($commandProvincia);
                $provincia = $this->provinciaRepository->byName($nameProvincia);
            }

            if(null !== $nameMunicipi){
                $hasMunicipi = $provincia->hasMunicipi($nameMunicipi);
                if(empty($hasMunicipi)){
                   $provincia->registerMunicipi(
                       new Id($idMunicipi),
                       $nameMunicipi
                   );
                   $this->provinciaRepository->save($provincia);
                }
            }

            $idSite = UuidGenerator::generateId();
            if(isset($file['espai'])) {
                $site = $this->siteRepository->bySite($file['espai']);

                if (null === $site) {
                    $coordinates = (isset($file['longitud']) && isset($file['latitud'])) ? $file['longitud'] .', '. $file['latitud'] : null;
                    $commandSite = new CreateSiteCommand(
                        $idSite,
                        $file['espai'],
                        $file['adre_a'],
                        null,
                        $idMunicipi,
                        $coordinates,
                        null,
                        null,
                        null
                    );

                    $this->commandBus->handle($commandSite);
                } else {
                    $idSite = $site->id()->id();
                }
            }

            $activity = $this->activityRepository->byCode($file['codi']);

            if (null === $activity) {
                $tipus = isset($file['tags_categor_es']) ?  explode('/', $file['tags_categor_es']) : null;

                $commandActivity = new CreateActivityCommand(
                    UuidGenerator::generateId(),
                    $file['codi'],
                    $file['denominaci'],
                    $file['data_inici'],
                    $file['data_fi'],
                    $language,
                    $file['descripcio'] ?? null,
                    $file['imatges']?? null,
                    $file['enlla_os']?? null,
                    $file['url']?? null,
                    null,
                    null,
                    $idSite,
                    null,
                    $file['horari']?? null,
                    $tipus[1],
                    $file['subt_tol'] ?? null,
                    null,
                    null
                );
                $this->commandBus->handle($commandActivity);
            }
        }
    }
}