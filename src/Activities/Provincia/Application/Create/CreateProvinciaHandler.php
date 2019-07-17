<?php
declare(strict_types=1);

namespace App\Activities\Provincia\Application\Create;

use App\Activities\Provincia\Domain\Provincia;
use App\Shared\Bus\Event\EventBus;
use App\Activities\Provincia\Domain\Repository\ProvinciaRepository;
use App\Shared\Bus\Command\CommandHandler;

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


