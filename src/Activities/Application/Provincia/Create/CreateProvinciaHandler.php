<?php
declare(strict_types=1);

namespace App\Activities\Application\Provincia\Create;

use App\Activities\Domain\Provincia\Provincia;
use App\Activities\Domain\Provincia\Repository\ProvinciaRepository;
use App\Activities\Domain\Shared\Bus\Command\CommandHandler;
use App\Activities\Domain\Shared\Bus\Event\EventBus;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Activities\Toolkit\IdGenerator\UuidGenerator;

final class CreateProvinciaHandler implements CommandHandler
{
    /** @var ProvinciaRepository */
    private $provinciaRepository;

    /** @var EventBus  */
    private $eventBus;

    public function __construct(ProvinciaRepository $provinciaRepository, EventBus $eventBus)
    {
        $this->provinciaRepository = $provinciaRepository;
        $this->eventBus = $eventBus;
    }

    public function handle(CreateProvinciaCommand $command): void
    {
        $provincia = new Provincia(
            $command->id(),
            $command->code(),
            $command->name()
        );

        $provincia->registerMunicipi($command->municipiId(), $command->municipiName());

        $this->eventBus->publish(new ProvinciaWasCreated($provincia->id()->id(), $command->code(), $provincia->name()));

        $this->provinciaRepository->save($provincia);
    }
}


