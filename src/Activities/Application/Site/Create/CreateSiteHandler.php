<?php

declare(strict_types=1);

namespace App\Activities\Application\Site\Create;

use App\Activities\Domain\Shared\Bus\CommandHandler;
use App\Activities\Domain\Shared\Bus\EventBus;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Activities\Domain\Site\Repository\SiteRepository;
use App\Activities\Domain\Site\Site;


final class CreateSiteHandler implements CommandHandler
{
    /** @var SiteRepository */
    private $siteRepository;

    /** @var EventBus  */
    private $eventBus;

    public function __construct(SiteRepository $siteRepository, EventBus $eventBus)
    {
        $this->siteRepository = $siteRepository;
        $this->eventBus = $eventBus;
    }

    public function handle(CreateSiteCommand $command): void
    {
        $site = new Site(
            new Id($command->id()),
            $command->site(),
            $command->address(),
            $command->postalCode(),
            new Id($command->municipiId()),
            $command->coordinates()
        );

        $this->siteRepository->save($site);
    }
}


