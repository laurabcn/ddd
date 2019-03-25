<?php
declare(strict_types=1);

namespace App\Activities\Domain\Shared\Bus\Event;

interface EventBus
{
    public function publish(Event ...$events): void;
}
