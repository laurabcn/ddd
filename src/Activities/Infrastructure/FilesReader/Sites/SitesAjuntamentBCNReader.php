<?php
declare(strict_types=1);

namespace App\Activities\Infrastructure\FilesReader\Sites;

use App\Activities\Application\Site\Create\CreateSiteCommand;
use App\Activities\Domain\FilesReader\FilesReader;
use App\Activities\Domain\Provincia\Repository\ProvinciaRepository;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Activities\Domain\Site\Repository\SiteRepository;
use App\Activities\Toolkit\IdGenerator\UuidGenerator;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

class SitesAjuntamentBCNReader implements FilesReader
{
    /** @var GetSitesFromOpenData */
    private $getSitesFromOpenData;

    /** @var ProvinciaRepository  */
    private $provinciaRepository;

    /** @var SiteRepository  */
    private $siteRepository;

    /** @var CommandBus $commandBus  */
    private $commandBus;

    public function __construct(
        GetSitesFromOpenData $getSitesFromOpenData,
        ProvinciaRepository $provinciaRepository,
        SiteRepository $siteRepository,
        CommandBus $commandBus
    )
    {
        $this->getSitesFromOpenData = $getSitesFromOpenData;
        $this->provinciaRepository = $provinciaRepository;
        $this->siteRepository = $siteRepository;
        $this->commandBus = $commandBus;
    }

    public function read(string $language): void
    {
        $files = $this->getSitesFromOpenData->execute($language);

        foreach ($files as $file) {
            $idSite = new Id(UuidGenerator::generateId());
            $site = $this->siteRepository->bySite($file['title']);

            $provincia = $this->provinciaRepository->byName('Barcelona');

            $coordinates = isset($file['coordaddressx']) && isset( $file['coordaddressy']) ? $file['coordaddressx']. ', ' . $file['coordaddressy'] : null;

            if (null === $site) {
                $commandSite = new CreateSiteCommand(
                    $idSite,
                    $file['title'],
                    $file['address'],
                    null,
                    $provincia->getMunicipiByName('Barcelona')->id(),
                    $coordinates,
                    $file['phonenumber']??null,
                    $file['content']??null,
                    $file['code_url']??null
                );

                $this->commandBus->handle($commandSite);
            }
        }
    }
}