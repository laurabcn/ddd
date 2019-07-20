<?php

declare(strict_types = 1);

namespace App\Activities\Activity\Application\Find;

use App\Shared\ValueObject\Id;

final class FindActivityQuery
{
    private $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public function id(): Id
    {
        return $this->id;
    }
}