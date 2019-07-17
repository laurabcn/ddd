<?php
declare (strict_types = 1);

namespace App\Activities\Domain\Shared\Bus;

use App\Activities\Domain\Shared\ValueObject\Uuid;

abstract class Request extends Message
{
    public function id(): Uuid
    {
        return $this->messageId();
    }
}
