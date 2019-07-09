<?php
declare(strict_types=1);

namespace App\Test\Activities\Application\Activity\Create;

use App\Activities\Application\Provincia\Create\CreateProvinciaCommand;
use App\Activities\Application\Provincia\Create\CreateProvinciaHandler;
use App\Activities\Application\Provincia\Create\ProvinciaWasCreated;
use App\Activities\Domain\Provincia\Municipi;
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
    public function handleWhenProvinciahasData()
    {
        $municipi = new Municipi(
            $municipiId = $this->faker->uuid,
            $municipiName = $this->faker->name,
            $provinciaId = $this->faker->uuid
        );
        $event = new ProvinciaWasCreated($provinciaId, $provinciaName = $this->faker->name);
        $command = new CreateProvinciaCommand($provinciaId, $provinciaName, [$municipiId  => $municipiName]);
        $provincia = $this->aProvinciaExists();

        $this->theProvinciaHasId($provincia, new Id($provinciaId));
        $this->theProvinciaHasName($provincia, $provinciaName);
        $this->theProvinciaRegisterMunicipi($provincia,$municipi);

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
}
