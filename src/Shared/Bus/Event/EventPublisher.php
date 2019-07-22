<?php

declare(strict_types=1);

namespace App\Shared\Bus\Event;

interface EventPublisher
{
    /**
     * Records events to be published afterwards using the publishRecorded method.
     */
    public function record(Event ...$domainEvents): void;

    /**
     * Publishes previously recorded events.
     */
    public function publishRecorded(): void;

    /**
     * Immediately publishes the received events.
     */
    public function publish(Event ...$domainEvents);
}
