<?php
declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

use App\Shared\Bus\Event\Event;
use App\Shared\ValueObject\Id;

abstract class AggregateRoot
{
    /** Event[] */
    private $events = [];

    abstract public function id(): Id;

    public function record(Event $event): void
    {
        $this->events[] = $event;
    }

    /** @return Event[] */
    public function uncommittedEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    /** @return Event[] */
    public function events(): array
    {
        return $this->events;
    }
}
