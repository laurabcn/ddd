<?php
declare(strict_types=1);

namespace App\Test\Activities\Application\Activity\Create;

use App\Activities\Application\Activity\Create\CreateActivityCommand;
use App\Activities\Application\Activity\Create\CreateActivityHandler;
use App\Activities\Domain\Activity\Activity;
use App\Activities\Domain\Activity\Repository\ActivityRepository;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Tests\Unit\Activities\Context\Activity\ActivityContext;
use App\Tests\Unit\Activities\Core\UnitTestCase;
use DateTime;
use PHPUnit\Framework\MockObject\MockObject;


class CreateActivityHandlerTest extends UnitTestCase
{
    use ActivityContext;

    /** @var ActivityRepository | MockObject */
    private $activityRepository;
    /** @var CreateActivityHandler */
    private $createActivityHandler;

    protected function setUp(): void
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
            new Id($this->faker->uuid),
            $this->faker->uuid,
            $this->faker->name,
            (new \DateTimeImmutable('today'))->format('Y-m-d'),
            (new \DateTimeImmutable('tomorrow'))->format('Y-m-d'),
            $this->faker->text,
            $this->faker->text,
            $this->faker->url,
            $this->faker->url,
            $this->faker->url,
            $this->faker->email,
            (string) $this->faker->randomNumber(9),
            new Id($this->faker->uuid),
            $this->faker->text(5),
            $this->faker->text(10),
            $this->faker->text(10),
            $this->faker->text(10),
            $this->faker->text(10),
            $this->faker->text(10)
        );

        $activity = new Activity(
            $command->id(),
            $command->acteId(),
            $command->title(),
            new \DateTimeImmutable($command->startDate()),
            new \DateTimeImmutable($command->endDate()),
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
            new Id($this->faker->uuid),
            $this->faker->uuid,
            $this->faker->name,
            (new DateTime('today'))->format('Y-m-d'),
            (new DateTime('tomorrow'))->format('Y-m-d'),
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

        $activity = new Activity(
            $command->id(),
            $command->acteId(),
            $command->title(),
            new \DateTimeImmutable($command->startDate()),
            new \DateTimeImmutable($command->endDate()),
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

        $this->activityRepository
            ->expects($this->once())
            ->method('save')
            ->with($activity);

        $this->createActivityHandler->handle($command);
    }
}
