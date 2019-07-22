<?php

declare(strict_types=1);

namespace App\Activities\FilesReader\Domain;

interface FilesReader
{
    public function read(string $language): void;
}
