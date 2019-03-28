<?php

declare(strict_types=1);

namespace App\Activities\Application\Site\Create;

use App\Activities\Domain\Shared\Bus\Command\CommandHandler;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Activities\Domain\Site\Repository\SiteRepository;
use App\Activities\Domain\Site\Site;


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
            new Id($command->id()),
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


