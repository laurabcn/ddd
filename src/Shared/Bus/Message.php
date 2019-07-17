<?php
declare (strict_types = 1);

namespace App\Activities\Domain\Shared\Bus;

use App\Activities\Domain\Shared\ValueObject\Uuid;

abstract class Message
{
    private $messageId;

    public function __construct(Uuid $messageId)
    {
        $this->messageId = $messageId;
    }

    public function messageId(): Uuid
    {
        return $this->messageId;
    }

    abstract public function messageType(): string;
}
