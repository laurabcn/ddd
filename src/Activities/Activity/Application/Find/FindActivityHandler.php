<?php

declare(strict_types=1);

namespace App\Activities\Activity\Application\Find;

use App\Activities\Activity\Domain\Repository\ActivityRepository;
use App\Shared\CommandBus\QueryHandlerInterface;

class FindActivityHandler implements QueryHandlerInterface
{
    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function handle(FindActivityQuery $query): FindActivityResponse
    {
        $activity = $this->activityRepository->ByIdOrException($query->id());

        return new FindActivityResponse(
            $activity->id()->id(),
            $activity->title(),
            $activity->description(),
            $activity->duration(),
            $activity->startDate()->format('Y-m-d'),
            is_null($activity->endDate()) ? null : $activity->endDate()->format('Y-m-d'),
            $activity->image(),
            $activity->inscription(),
            $activity->observation(),
            $activity->url(),
            $activity->urlGeneral(),
            $activity->type()
        );
    }
}