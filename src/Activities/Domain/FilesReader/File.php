<?php

namespace App\Activities\Domain\FilesReader;

final class File
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function name(): string
    {
        return $this->name;
    }
}