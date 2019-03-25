<?php

declare(strict_types = 1);

namespace App\Activities\Domain\Shared\Bus\Event;

interface EventSubscriber
{
    public static function subscribedTo(): array;
}
