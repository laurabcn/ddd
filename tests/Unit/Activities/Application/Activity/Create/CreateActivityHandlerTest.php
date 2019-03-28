<?php
declare(strict_types=1);

namespace App\Test\Activities\Application\Activity\Create;

use App\Activities\Application\Activity\Create\CreateActivityCommand;
use App\Activities\Application\Activity\Create\CreateActivityHandler;
use App\Activities\Domain\Activity\Repository\ActivityRepository;
use App\Tests\Unit\Activities\Context\Activity\ActivityContext;
use App\Tests\Unit\Activities\Core\UnitTestCase;


class CreateActivityHandlerTest extends UnitTestCase
{
    use ActivityContext;

    /** @var ActivityRepository | \PHPUnit_Framework_MockObject_MockObject */
    private $activityRepository;
    /** @var CreateActivityHandler */
    private $createActivityHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->activityRepository = $this->createMock(ActivityRepository::class);
        $this->createActivityHandler = new CreateActivityHandler($this->activityRepository);
    }

    /**
     * @test
     */
    public function handleWhenActivityhasData()
    {
        $command = new CreateActivityCommand(
            $this->faker->uuid,
            $this->faker->uuid,
            $this->faker->name,
            new \DateTime('today'),
            new \DateTime('tomorrow'),
            $this->faker->name,
            $this->faker->url,
            $this->faker->url,
            $this->faker->email,
            $this->faker->randomNumber(9),
            $this->faker->uuid,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name
        );

        $activity = $this->aActivityExists();

        $this->activityRepository
            ->expects($this->once())
            ->method('save')
            ->with($activity);

        $this->createActivityHandler->handle($command);
    }

    /**
     * @test
     */
    public function handleWhenActivityhasDataWithNull()
    {
        $command = new CreateActivityCommand(
            $this->faker->uuid,
            $this->faker->uuid,
            $this->faker->name,
            new \DateTime('today'),
            new \DateTime('tomorrow'),
            $this->faker->name,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $activity = $this->aActivityExists();

        $this->activityRepository
            ->expects($this->once())
            ->method('save')
            ->with($activity);

        $this->createActivityHandler->handle($command);
    }
}
