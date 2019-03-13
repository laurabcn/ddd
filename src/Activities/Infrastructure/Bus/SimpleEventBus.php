<?php
declare(strict_types=1);

namespace App\Activities\Infrastructure\Bus;


use App\Activities\Domain\Shared\Bus\Event;
use App\Activities\Domain\Shared\Bus\EventBus;

class SimpleEventBus implements EventBus
{
    /** @var \SimpleBus\SymfonyBridge\Bus\EventBus */
    private $eventBus;

    public function __construct(\SimpleBus\SymfonyBridge\Bus\EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function handle($event): void
    {
        $this->eventBus->handle($event);
    }

    public function publish(Event ...$events): void
    {
        foreach ($events as $event) {
            $this->eventBus->handle($event);
        }
    }
}
