<?php
declare(strict_types=1);

namespace App\Activities\Domain\Shared\Aggregate;

use App\Activities\Domain\Shared\Bus\Event;

abstract class AggregateRoot
{
    /** Event[] */
    private $events = [];

    abstract public function id(): string;

    public function recordThat(Event $event): void
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