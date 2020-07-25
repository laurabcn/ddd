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

class ActivitiesGeneralitatCatalaReader implements FilesReader
{
    /** @var GetActivitiesFromSocrata */
    private $getActivitiesFromSocrata;

    /** @var GetActivitiesFromSocrataLocalitzacions */
    private $getActivitiesFromSocrataLocalitzacions;

    /** @var GetActivitiesFromSocrataOrganitzadors */
    private $getActivitiesFromSocrataOrganitzadors;

    /** @var ProvinciaRepository */
    private $provinciaRepository;

    /** @var SiteRepository */
    private $siteRepository;

    /** @var ActivityRepository */
    private $activityRepository;

    /** @var CommandBus $commandBus */
    private $commandBus;

    public function __construct(
        GetActivitiesFromSocrata $getActivitiesFromSocrata,
        GetActivitiesFromSocrataOrganitzadors $getActivitiesFromSocrataOrganitzadors,
        GetActivitiesFromSocrataLocalitzacions $activitiesFromSocrataLocalitzacions,
        ProvinciaRepository $provinciaRepository,
        SiteRepository $siteRepository,
        ActivityRepository $sctivityRepository,
        CommandBus $commandBus
    ) {
        $this->getActivitiesFromSocrata = $getActivitiesFromSocrata;
        $this->getActivitiesFromSocrataOrganitzadors = $getActivitiesFromSocrataOrganitzadors;
        $this->getActivitiesFromSocrataLocalitzacions = $activitiesFromSocrataLocalitzacions;
        $this->provinciaRepository = $provinciaRepository;
        $this->siteRepository = $siteRepository;
        $this->activityRepository = $sctivityRepository;
        $this->commandBus = $commandBus;
    }

    public function read(string $language): void
    {
        $files0 = $this->getActivitiesFromSocrata->execute();
        $files1 = $this->getActivitiesFromSocrataLocalitzacions->execute();
        $files2 = $this->getActivitiesFromSocrataOrganitzadors->execute();
        $files = array_merge($files1, $files2, $files0);
        var_dump(count($files));var_dump(count($files1));var_dump(count($files2));
      //  var_dump($files[0]);var_dump($files1[0]);
        var_dump('he arribatkjjjj');
        $i = 0;
        foreach ($files as $index => $file) {
            $comarca = isset( $file['comarca_i_municipi']) ? explode('/', $file['comarca_i_municipi']):null;
            $idMunicipi = new Id(UuidGenerator::generateId());
            $idProvincia = !isset($file['rel_municipis']['grup_provincia']['provincia_codi']) ? '8' : $file['rel_municipis']['grup_provincia']['provincia_codi'];
            $nameMunicipi = !isset($comarca[3]) ? null : $comarca[3];
            $nameProvincia = !isset($comarca[1]) ? null : $comarca[1];

            if (!is_null($nameProvincia)) {
                /** @var string $nameProvincia */
                $provincia = $this->provinciaRepository->byName($nameProvincia);

                if (is_null($provincia) && !empty($nameMunicipi)) {
                    /** @var string $nameMunicipi */
                    $commandProvincia = new CreateProvinciaCommand(
                        new Id(UuidGenerator::generateId()),
                        $idProvincia,
                        $nameProvincia,
                        $idMunicipi,
                        $nameMunicipi
                    );
                    $this->commandBus->handle($commandProvincia);
                    $provincia = $this->provinciaRepository->byName($nameProvincia);
                }
            }

            /** @var string $nameMunicipi */
            if (!is_null($nameMunicipi) && !$provincia->hasMunicipi($nameMunicipi)) {
                $provincia->registerMunicipi(
                   $idMunicipi,
                   $nameMunicipi
               );
                $this->provinciaRepository->save($provincia);
            }

            $idSite = new Id(UuidGenerator::generateId());
            if (isset($file['espai'])) {
                $site = $this->siteRepository->bySite($file['espai']);

                if (null === $site) {
                    $coordinates = (isset($file['longitud']) && isset($file['latitud'])) ? $file['longitud'] . ', ' . $file['latitud'] : null;
                    $commandSite = new CreateSiteCommand(
                        $idSite,
                        $file['espai'],
                        $file['adre_a']?? null,
                        null,
                        $idMunicipi,
                        $coordinates,
                        null,
                        null,
                        null
                    );

                    $this->commandBus->handle($commandSite);
                } else {
                    $idSite = $site->id();
                }
            }

            $activity = $this->activityRepository->byCode($file['codi']);

            $activities[]= $activity;

            if (null === $activity) {
                $tipus = isset($file['tags_categor_es']) ? explode('/', $file['tags_categor_es']) : null;
                if(empty($tipus)){
                    $tipus = isset($file['tags_mbits']) ? explode('/', $file['tags_mbits']) : null;
                }

                $commandActivity = new CreateActivityCommand(
                    new Id(UuidGenerator::generateId()),
                    $file['codi'],
                    $file['denominaci'],
                    $file['data_inici'] ?? (new \DateTime())->format('Y-m-d'),
                    $file['data_fi'],
                    $language,
                    $file['descripcio'] ?? null,
                    $file['imatges'] ?? null,
                    $file['enlla_os'] ?? null,
                    $file['url'] ?? null,
                    null,
                    null,
                    $idSite,
                    $file['entrades'] ?? null,
                    $file['horari'] ?? null,
                    $tipus[1],
                    $file['subt_tol'] ?? null,
                    null,
                    null
                );
                $this->commandBus->handle($commandActivity);
                $i++;
            }
        }
        dump($i);  dump(count($activities));dump(count($files));
    }
}
