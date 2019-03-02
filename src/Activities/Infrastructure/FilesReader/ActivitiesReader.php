<?php

namespace App\Activities\Infrastructure\FilesReader;

use App\Activities\Application\Activity\Create\CreateActivityCommand;
use App\Activities\Application\Municipi\Create\CreateMunicipiCommand;
use App\Activities\Application\Site\Create\CreateSiteCommand;
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

    public function read(string $path): void
    {
        $filestourism = $this->getActivitiesFromOpenData->execute($path);
        $fileslibrary = $this->getActivitiesFromOpenDataLibraries->execute($path);

        $files = array_merge($filestourism, $fileslibrary);

        foreach ($files as $file) {
            $commandMunicipi = new CreateMunicipiCommand(
                $idMunicipi = (isset( $file['rel_municipis']['grup_provincia'])) ? $file['rel_municipis']['grup_provincia']['provincia_codi']: '8',
                isset($file['rel_municipis']['municipi_nom']) ? $file['rel_municipis']['municipi_nom'] : 'Barcelona'
            );

            $this->commandBus->handle($commandMunicipi);
            $commandSite = new CreateSiteCommand(
                $idSite = UuidGenerator::generateId(),
                $file['grup_adreca']['adreca_nom'],
                $file['grup_adreca']['adreca'],
                $file['grup_adreca']['codi_postal'],
                $idMunicipi,
                $file['grup_adreca']['localitzacio']
            );

            $this->commandBus->handle($commandSite);

            $imatge = count($file['imatge']) > 0 ? $file['imatge'][0] : null;
            $tipus = count($file['tipus']) > 0 ? $file['tipus'][0] : null;
            $email = count($file['email']) > 0 ? $file['email'][0] : null;
            $phone = count($file['telefon_contacte']) > 0 ? $file['telefon_contacte'][0] : null;

            $commandActivity = new CreateActivityCommand(
                $file['acte_id'],
                $file['titol'],
                $file['data_inici'],
                $file['data_fi'],
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