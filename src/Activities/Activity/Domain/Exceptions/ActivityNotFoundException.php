<?php

declare(strict_types=1);

namespace App\Activities\Activity\Domain\Exceptions;

use App\Shared\ValueObject\Id;

class ActivityNotFoundException extends \Exception
{
    const MESSAGE_NOT_FOUND_BY_ID = 'Activity not found by Id: ';

    public function __construct(Id $id)
    {
        parent::__construct(self::MESSAGE_NOT_FOUND_BY_ID . $id->id());
    }
}
