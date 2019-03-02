<?php
declare(strict_types=1);

namespace App\Activities\Application\Municipi\Create;

use App\Activities\Domain\Municipi\Municipi;
use App\Activities\Domain\Municipi\Repository\MunicipiRepository;
use App\Activities\Domain\Shared\Bus\CommandHandler;
use App\Activities\Domain\Shared\Bus\EventBus;
use App\Activities\Domain\Shared\ValueObject\Id;

final class CreateMunicipiHandler implements CommandHandler
{
    /** @var MunicipiRepository */
    private $municipiRepository;

    /** @var EventBus  */
    private $eventBus;

    public function __construct(MunicipiRepository $municipiRepository, EventBus $eventBus)
    {
        $this->municipiRepository = $municipiRepository;
        $this->eventBus = $eventBus;
    }

    public function handle(CreateMunicipiCommand $command): void
    {
        $municipi = $this->municipiRepository->byId(new Id($command->id()));

        if(null === $municipi){

            $municipi = new Municipi(
                $command->id(),
                $command->name()
            );

            $this->municipiRepository->save($municipi);
        }
    }
}


