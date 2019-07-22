<?php

declare(strict_types=1);

namespace App\Shared\Bus;

use App\Shared\Bus\Event\Event;
use App\Shared\Bus\Event\EventBus;

class Bus implements EventBus
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
