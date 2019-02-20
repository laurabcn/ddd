<?php

namespace App\Activities\Infrastructure\FilesReader;

use App\Activities\Activity\Application\Create\CreateActivityCommand;
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
        $activity = [];

        foreach ($files as $file) {
            //var_dump(); //die();

            $municipi = [
                'idMunicipi' => $idMunicipi = UuidGenerator::generateId(),
                'municipi' => $file['grup_adreca']['municipi']
            ];

            $site = [
                'id' => $idSite = UuidGenerator::generateId(),
                'site' => $file['grup_adreca']['adreca_nom'],
                'address' => $file['grup_adreca']['adreca'],
                'codi_postal' => $file['grup_adreca']['codi_postal'],
                'idMunicipi' => $idMunicipi,
                'coordenates' => $file['grup_adreca']['localitzacio']
            ];


            $activity = [
                'id'           => $file['acte_id'],
                'title'        => $file['titol'],
                'start_date'   => $file['data_inici'],
                'end_date'     => $file['data_fi'],
                'description'  => $file['descripcio'],
                'image'        => $file['imatge'],
                'url'          => $file['acte_url'],
                'url_gral'     => $file['url_general'],
                'email'        => $file['email'],
                'phone'        => $file['telefon_contacte'],
                'address'      => $file['grup_adreca'],
                'municipi'     => $file["rel_municipis"],
                'tags'         => $file['tags'],
                'preu'         => $file['preu'],
                'category'     => $file['categoria'],
                'durada'       => $file['durada'],
                'tipus'        => $file['tipus'],
                'observacions' => $file['observacions'],
                'capacity'     => $file['aforament'],
                'inscription'  => $file['inscripcio']
            ];

            $command = new CreateActivityCommand(
                $activity['id'],
                $activity['title'],
                $activity['start_date'],
                $activity['end_date'],
                $activity['description'],
                $activity['image'],
                $activity['url'],
                $activity['url_gral'],
                $activity['email'],
                $activity['phone'],
                $activity['address'],
                $activity['municipi'],
                $activity['tags'],
                $activity['preu'],
                $activity['category'],
                $activity['durada'],
                $activity['tipus'],
                $activity['observacions'],
                $activity['capacity'],
                $activity['inscription']
            );
            $this->commandBus->handle($command);
        }
    }
}