<?php

declare(strict_types=1);

namespace App\Activities\Application\Activity\Create;

use App\Activities\Domain\Activity\Activity;
use App\Activities\Domain\Activity\Repository\ActivityRepository;
use App\Activities\Domain\Shared\Bus\CommandHandler;
use App\Activities\Domain\Shared\Bus\EventBus;
use App\Activities\Domain\Shared\ValueObject\Id;

final class CreateActivityHandler implements CommandHandler
{
    /** @var ActivityRepository */
    private $activityRepository;

    /** @var EventBus  */
    private $eventBus;

    public function __construct(ActivityRepository $activityRepository, EventBus $eventBus)
    {
        $this->activityRepository = $activityRepository;
        $this->eventBus = $eventBus;
    }

    public function handle(CreateActivityCommand $command): void
    {
        $activity = new Activity(
            $command->id(),
            $command->title(),
            new \DateTime($command->startDate()),
            new \DateTime($command->endDate()),
            $command->description(),
            $command->image(),
            $command->url(),
            $command->urlGeneral(),
            $command->email(),
            $command->phone(),
            new Id($command->siteId()),
            $command->price(),
            $command->duration(),
            $command->type(),
            $command->observation(),
            $command->capacity(),
            $command->inscription()
        );

        $this->activityRepository->save($activity);

        $this->eventBus->publish(...$activity->uncommittedEvents());
    }
}


