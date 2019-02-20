<?php

declare(strict_types=1);

namespace App\Activities\Shared\Bus;

interface Bus
{
    /** @param Command|Event $commandOrEvent */
    public function handle($commandOrEvent): void;
}
