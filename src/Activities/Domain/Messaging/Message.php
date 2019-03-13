<?php
declare(strict_types=1);

namespace App\Activities\Domain\Messaging;

interface Message
{
    public function messageName(): string;

    public function fromPayload(array $payload): object;

    public function toPayload(): array;
}
