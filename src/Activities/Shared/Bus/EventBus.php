<?php

declare(strict_types=1);

namespace App\Activities\Shared\Bus;

interface EventBus extends Bus
{
    public function publish(Event ...$events): void;
}
