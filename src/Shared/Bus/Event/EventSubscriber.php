<?php

declare(strict_types=1);

namespace App\Shared\Bus\Event;

interface EventSubscriber
{
    public static function subscribedTo(): array;
}
