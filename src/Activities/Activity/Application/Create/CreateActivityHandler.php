<?php

declare(strict_types=1);

namespace App\Activities\Activity\Application\Create;

use App\Activities\Activity\Domain\Activity;
use App\Activities\Activity\Domain\Repository\ActivityRepository;
use App\Shared\Bus\Command\CommandHandler;

final class CreateActivityHandler implements CommandHandler
{
    /** @var ActivityRepository */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
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
    }
}


