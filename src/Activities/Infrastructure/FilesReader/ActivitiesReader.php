<?php

namespace App\Activities\Infrastructure\FilesReader;

use App\Activities\Application\Activity\Create\CreateActivityCommand;
use App\Activities\Application\Activity\Create\CreateMunicipiCommand;
use App\Activities\Domain\FilesReader\File;
use App\Activities\Domain\FilesReader\FilesReader;
use App\Activities\Toolkit\IdGenerator\UuidGenerator;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class ActivitiesReader implements FilesReader
{
    /** @var GetActivitiesFromOpenData */
    private $getActivitiesFromOpenData;

    /** @var GetActivitiesFromOpenDataLibraries */
    private $getActivitiesFromOpenDataLibraries;

    /** @var CommandBus $commandBus  */
    private $commandBus;

    public function __construct(
        GetActivitiesFromOpenData $getActivitiesFromOpenData,
        GetActivitiesFromOpenDataLibraries $getActivitiesFromOpenDataLibraries,
        \SimpleBus\SymfonyBridge\Bus\CommandBus $commandBus
    )
    {
        $this->getActivitiesFromOpenData = $getActivitiesFromOpenData;
        $this->getActivitiesFromOpenDataLibraries = $getActivitiesFromOpenDataLibraries;
        $this->commandBus = $commandBus;
    }

    /** @return File[] */
    public function read(string $path): void
    {
        $filestourism = $this->getActivitiesFromOpenData->execute($path);
        $fileslibrary = $this->getActivitiesFromOpenDataLibraries->execute($path);

        $files = array_merge($filestourism, $fileslibrary);

        foreach ($files as $file) {
            $command = new CreateMunicipiCommand(
                $idMunicipi = $file['rel_municipis']['grup_provincia']['provincia_codi'],
                $file['rel_municipis']['municipi_nom']);

            $this->commandBus->handle($command);

            $site = [
                'id' => $idSite = UuidGenerator::generateId(),
                'site' => $file['grup_adreca']['adreca_nom'],
                'address' => $file['grup_adreca']['adreca'],
                'codi_postal' => $file['grup_adreca']['codi_postal'],
                'idMunicipi' => $idMunicipi,
                'idComarca' => $idComarca,
                'coordenates' => $file['grup_adreca']['localitzacio']
            ];

            $command = new CreateActivityCommand(
                $file['acte_id'],
                $file['titol'],
                $file['data_inici'],
                $file['data_fi'],
                $file['descripcio'],
                $file['imatge'][],
                $file['acte_url'],
                $file['url_general'],
                $file['email'],
                $file['telefon_contacte'],
                $idSite,
                $idMunicipi,
                $file['preu'],
                $file['durada'],
                $file['tipus'][],
                $file['observacions'],
                $file['capacity'],
                $file['inscription']
            );
            $this->commandBus->handle($command);
        }
    }
}