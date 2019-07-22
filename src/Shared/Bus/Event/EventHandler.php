<?php

declare(strict_types=1);

namespace App\Shared\Bus\Event;

interface EventHandler
{
    public function handle(Event $event): void;
}
