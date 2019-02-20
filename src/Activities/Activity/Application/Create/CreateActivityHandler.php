<?php

declare(strict_types=1);

namespace App\Activities\Activity\Application\Create;

use App\Activities\Activity\Domain\Activity;
use App\Activities\Activity\Domain\Repository\ActivityRepository;
use App\Activities\Shared\Bus\CommandHandler;
use App\Activities\Shared\Bus\EventBus;
use App\Activities\Toolkit\IdGenerator\UuidGenerator;

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
            $command->startDate(),
            $command->endDate(),
            $command->description(),
            $command->image(),
            $command->url(),
            $command->urlGeneral(),
            $command->email(),
            $command->phone(),
            $command->address(),
            $command->municipi(),
            $command->municipi(),
            $command->tags(),
            $command->price(),
            $command->category(),
            $command->duration(),
            $command->types(),
            $command->observation(),
            $command->capacity(),
            $command->inscription()
        );

        $this->activityRepository->save($activity);

        $this->eventBus->publish(...$activity->uncommittedEvents());
    }
}


