<?php
declare(strict_types=1);

namespace App\Activities\Application\Provincia\Create;

use App\Activities\Domain\Provincia\Municipi;
use App\Activities\Domain\Provincia\Provincia;
use App\Activities\Domain\Provincia\Repository\ProvinciaRepository;
use App\Activities\Domain\Shared\Bus\CommandHandler;
use App\Activities\Domain\Shared\Bus\EventBus;
use App\Activities\Domain\Shared\ValueObject\Id;

final class CreateProvinciaHandler implements CommandHandler
{
    /** @var ProvinciaRepository */
    private $provinciaRepository;

    /** @var EventBus  */
    private $eventBus;

    public function __construct(ProvinciaRepository $municipiRepository, EventBus $eventBus)
    {
        $this->provinciaRepository = $municipiRepository;
        $this->eventBus = $eventBus;
    }

    public function handle(CreateProvinciaCommand $command): void
    {
        $provincia = new Provincia(
            $command->id(),
            $command->name()
        );

        foreach ($command->municipi() as $key => $municipi)
        {
            $provincia->registerMunicipi(new Id($key), $municipi);
        }

        $this->provinciaRepository->save($provincia);
    }
}


