<?php
declare(strict_types=1);

namespace App\Test\Activities\Application\Activity\Create;

use App\Activities\Application\Provincia\Create\CreateProvinciaCommand;
use App\Activities\Application\Provincia\Create\CreateProvinciaHandler;
use App\Activities\Application\Provincia\Create\ProvinciaWasCreated;
use App\Activities\Domain\Provincia\Municipi;
use App\Activities\Domain\Provincia\Provincia;
use App\Activities\Domain\Provincia\Repository\ProvinciaRepository;
use App\Activities\Domain\Shared\Bus\Event\EventBus;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Tests\Unit\Activities\Context\Provincia\ProvinciaContext;
use App\Tests\Unit\Activities\Core\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;


class CreateProvinciaHandlerTest extends UnitTestCase
{
    use ProvinciaContext;

    /** @var ProvinciaRepository | MockObject */
    private $provinciaRepository;

    /** @var EventBus | MockObject */
    private $eventBus;

    /** @var CreateProvinciaHandler */
    private $createProvinciaHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->provinciaRepository = $this->createMock(ProvinciaRepository::class);
        $this->eventBus = $this->createMock(EventBus::class);
        $this->createProvinciaHandler = new CreateProvinciaHandler(
            $this->provinciaRepository,
            $this->eventBus
        );
    }

    /**
     * @test
     */
    public function handleWhenProvinciaHasOneMunicipiData()
    {
        $municipi = new Municipi(
            $municipiId = new Id($this->faker->uuid),
            $municipiName = $this->faker->name
        );

        $provinciaId = new Id($this->faker->uuid);
        $event = new ProvinciaWasCreated($provinciaId->id(), $code = '08', $provinciaName = $this->faker->name);
        $command = new CreateProvinciaCommand(
            $provinciaId,
            $code,
            $provinciaName,
            $municipiId,
            $municipiName
        );

        $provincia = new Provincia($command->id(), $command->code(), $command->name());
        $provincia->addMunicipi($municipi);

        $this->eventBus
            ->expects($this->once())
            ->method('publish')
            ->with($event);

        $this->provinciaRepository
            ->expects($this->once())
            ->method('save')
            ->with($provincia);

        $this->createProvinciaHandler->handle($command);
    }

    /**
     * @test
     */
    public function handleWhenProvinciaHasOneMunicipiDataAndAddSameAndDifferent()
    {
        $municipi = new Municipi(
            $municipiId = new Id($this->faker->uuid),
            $municipiName = $this->faker->name
        );

        $provinciaId = new Id($this->faker->uuid);
        $event = new ProvinciaWasCreated($provinciaId->id(), $code = '08', $provinciaName = $this->faker->name);
        $command = new CreateProvinciaCommand(
            $provinciaId,
            $code,
            $provinciaName,
            $municipiId,
            $municipiName
        );

        $provincia = new Provincia($command->id(), $command->code(), $command->name());
        $provincia->addMunicipi($municipi);

        $this->assertCount(1, $provincia->municipi());

        $provincia->addMunicipi($municipi);

        $this->assertCount(1, $provincia->municipi());

        $this->eventBus
            ->expects($this->once())
            ->method('publish')
            ->with($event);

        $this->provinciaRepository
            ->expects($this->once())
            ->method('save')
            ->with($provincia);

        $this->createProvinciaHandler->handle($command);

        $municipi2 = new Municipi(
            new Id($this->faker->uuid),
            $this->faker->name
        );

        $provincia->addMunicipi($municipi2);

        $this->assertCount(2, $provincia->municipi());
    }
}
