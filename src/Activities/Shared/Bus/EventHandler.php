<?php

declare(strict_types=1);

namespace App\Activities\Shared\Bus;

interface EventHandler
{
    public function handle(Event $event): void;
}
