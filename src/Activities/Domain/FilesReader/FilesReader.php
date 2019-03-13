<?php
declare(strict_types=1);

namespace App\Activities\Domain\FilesReader;

interface FilesReader
{
    public function read(string $language) : void;
}