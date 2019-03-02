<?php

declare(strict_types = 1);

namespace App\Activities\Application\Municipi\Find;


final class FindMunicipiQuery
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