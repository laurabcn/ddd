<?php

declare(strict_types = 1);

namespace App\Activities\Activity\Application\Find;


final class FindActivityQuery
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}