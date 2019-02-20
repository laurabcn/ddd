<?php

namespace App\Activities\Domain\FilesReader;

interface FilesReader
{
    /** @return File[] */
    public function read(string $path) : void;
}