<?php
declare(strict_types=1);

namespace App\Activities\Infrastructure\Bus;

use App\Activities\Shared\Bus\Event;
use App\Activities\Shared\Bus\EventBus;
use Assert\Assertion;

class SimpleEventBus implements EventBus
{
    /** @var \SimpleBus\SymfonyBridge\Bus\EventBus */
    private $eventBus;

    public function __construct(\SimpleBus\SymfonyBridge\Bus\EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    /**
     * @param $event $event
     * @throws \Assert\AssertionFailedException
     */
    public function handle($event): void
    {
        Assertion::isInstanceOf($event, Event::class);
        $this->eventBus->handle($event);
    }

    public function publish(Event ...$events): void
    {
        foreach ($events as $event) {
            $this->eventBus->handle($event);
        }
    }
}
