<?php

declare(strict_types=1);

namespace App\Activities\Site\Application\Create;

use App\Activities\Site\Domain\Repository\SiteRepository;
use App\Activities\Site\Domain\Site;
use App\Shared\Bus\Command\CommandHandler;


final class CreateSiteHandler implements CommandHandler
{
    /** @var SiteRepository */
    private $siteRepository;

    public function __construct(SiteRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }

    public function handle(CreateSiteCommand $command): void
    {
        $site = new Site(
            $command->id(),
            $command->site(),
            $command->address(),
            $command->postalCode(),
            $command->municipiId(),
            $command->coordinates(),
            $command->phone(),
            $command->description(),
            $command->url()
        );

        $this->siteRepository->save($site);
    }
}


