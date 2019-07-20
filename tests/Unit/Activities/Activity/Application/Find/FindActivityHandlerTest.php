<?php

declare(strict_types=1);

namespace App\Test\Activities\Activity\Application\Find;

use App\Activities\Activity\Application\Find\FindActivityHandler;
use App\Activities\Activity\Application\Find\FindActivityQuery;
use App\Activities\Activity\Domain\Repository\ActivityRepository;
use App\Shared\ValueObject\Id;
use App\Tests\Unit\Activities\Context\Activity\ActivityContext;
use App\Tests\Unit\Activities\Core\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class FindActivityHandlerTest extends UnitTestCase
{
    use ActivityContext;

    /** @var ActivityRepository | MockObject */
    private $activityRepository;

    /** @var FindActivityHandler */
    private $findActivityHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->activityRepository = $this->createMock(ActivityRepository::class);
        $this->findActivityHandler = new FindActivityHandler($this->activityRepository);
    }

    /**
     * @test
     */
    public function handleWhenActivityHasData()
    {
        $query = new FindActivityQuery(
            $activityId = new Id($this->faker->uuid)
        );

        $activity = $this->anActivityExists();
        $this->theActivityHasId($activity, $activityId);
        $this->theActivityHasTitle($activity, $this->faker->text(30));
        $this->theActivityHasDescription($activity, $this->faker->text(30));
        $this->theActivityHasStartDate($activity, new \DateTime());
        $this->theActivityHasEndDate($activity, new \DateTime('+1 day'));
        $this->theActivityHasImage($activity, $this->faker->url);
        $this->theActivityHasInscription($activity, $this->faker->url);
        $this->theActivityHasObservation($activity, $this->faker->text(100));
        $this->theActivityHasUrl($activity, $this->faker->url);
        $this->theActivityHasUrlGeneral($activity, $this->faker->url);
        $this->theActivityHasType($activity, $this->faker->text(15));

        $this->activityRepository
            ->expects($this->once())
            ->method('ByIdOrException')
            ->with($query->id())
            ->willReturn($activity);

        $response = $this->findActivityHandler->handle($query);

        $this->assertEquals($activity->id()->id(), $response->id());
        $this->assertEquals($activity->title(), $response->title());
        $this->assertEquals($activity->description(), $response->description());
        $this->assertEquals($activity->duration(), $response->duration());
        $this->assertEquals($activity->startDate()->format('Y-m-d'), $response->startDate());
        $this->assertEquals($activity->endDate()->format('Y-m-d'), $response->endDate());
        $this->assertEquals($activity->image(), $response->image());
        $this->assertEquals($activity->inscription(), $response->inscriptions());
        $this->assertEquals($activity->observation(), $response->observations());
        $this->assertEquals($activity->url(), $response->url());
        $this->assertEquals($activity->urlGeneral(), $response->urlGeneral());
        $this->assertEquals($activity->type(), $response->type());
    }

    /**
     * @test
     */
    public function handleWhenActivityHasDataWithNull()
    {
        $query = new FindActivityQuery(
            $activityId = new Id($this->faker->uuid)
        );

        $activity = $this->anActivityExists();
        $this->theActivityHasId($activity, $activityId);
        $this->theActivityHasTitle($activity, $this->faker->text(30));
        $this->theActivityHasDescription($activity);
        $this->theActivityHasStartDate($activity, new \DateTime());
        $this->theActivityHasEndDate($activity);
        $this->theActivityHasImage($activity);
        $this->theActivityHasInscription($activity);
        $this->theActivityHasObservation($activity);
        $this->theActivityHasUrl($activity);
        $this->theActivityHasUrlGeneral($activity);
        $this->theActivityHasType($activity);

        $this->activityRepository
            ->expects($this->once())
            ->method('ByIdOrException')
            ->with($query->id())
            ->willReturn($activity);

        $response = $this->findActivityHandler->handle($query);

        $this->assertEquals($activity->id()->id(), $response->id());
        $this->assertEquals($activity->title(), $response->title());
        $this->assertEquals($activity->description(), $response->description());
        $this->assertEquals($activity->duration(), $response->duration());
        $this->assertEquals($activity->startDate()->format('Y-m-d'), $response->startDate());
        $this->assertEquals($activity->endDate(), $response->endDate());
        $this->assertEquals($activity->image(), $response->image());
        $this->assertEquals($activity->inscription(), $response->inscriptions());
        $this->assertEquals($activity->observation(), $response->observations());
        $this->assertEquals($activity->url(), $response->url());
        $this->assertEquals($activity->urlGeneral(), $response->urlGeneral());
        $this->assertEquals($activity->type(), $response->type());
    }
}
