<?php
declare(strict_types=1);

namespace App\Activities\Application\Activity\Find;

use App\Activities\Domain\Activity\Exceptions\ActivityNotFoundException;
use App\Activities\Domain\Activity\Repository\ActivityRepository;
use App\Activities\Domain\Shared\CommandBus\QueryHandlerInterface;
use App\Activities\Domain\Shared\ValueObject\Id;

class FindActivityHandler implements QueryHandlerInterface
{
    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    public function __construct(
        ActivityRepository $activityRepository
    ) {
        $this->activityRepository = $activityRepository;
    }

    public function handle(FindActivityQuery $query): FindActivityResponse
    {
        $activity = $this->activityRepository->ByIdOrException(new Id($query->id()));

        return new FindActivityResponse(
            $activity->id(),
            $activity->title(),
            $activity->description(),
            $activity->duration(),
            $activity->startDate(),
            $activity->endDate(),
            $activity->image(),
            $activity->inscription(),
            $activity->observation(),
            $activity->url(),
            $activity->urlGeneral(),
            $activity->type()
        );
    }
}