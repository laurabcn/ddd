<?php

declare(strict_types=1);

namespace App\Activities\Activity\Application\Create;

use App\Activities\Activity\Domain\Activity;
use App\Activities\Activity\Domain\Repository\ActivityRepository;
use App\Shared\Bus\Bus;
use App\Shared\Bus\Command\CommandHandler;
use SimpleBus\SymfonyBridge\Bus\EventBus;

final class CreateActivityHandler implements CommandHandler
{
    private ActivityRepository $activityRepository;

    private Bus $bus;

    public function __construct(ActivityRepository $activityRepository, Bus $bus)
    {
        $this->activityRepository = $activityRepository;
        $this->bus = $bus;
    }

    public function handle(CreateActivityCommand $command): void
    {
        $activity = new Activity(
            $command->id(),
            $command->acteId(),
            $command->title(),
            new \DateTimeImmutable($command->startDate()),
            is_null($command->endDate()) ? null : new \DateTimeImmutable($command->endDate()),
            $command->language(),
            $command->description(),
            $command->image(),
            $command->url(),
            $command->urlGeneral(),
            $command->email(),
            $command->phone(),
            is_null($command->siteId())? null : $command->siteId(),
            $command->price(),
            $command->duration(),
            $command->type(),
            $command->observation(),
            $command->capacity(),
            $command->inscription()
        );

        $this->activityRepository->save($activity);
        $this->bus->publish(...$activity->pullDomainEvents());
    }
}


