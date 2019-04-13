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
        $files = $this->getActivitiesFromOpenDataAjBcn->execute();

        foreach ($files as $file) {
            var_dump($file[0]); die();
            $nom = $file['nom_del_lloc'];
            $site = $this->siteRepository->bySite($nom);

            if (null === $site && null !== isset($nom)) {
                $commandSite = new CreateSiteCommand(
                    $idSite = UuidGenerator::generateId(),
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
                $idSite = $site->id()->id();
            }

            $commandActivity = new CreateActivityCommand(
                UuidGenerator::generateId(),
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

        $files = $this->getActivitiesFromOpenData->execute($language);

    }
}