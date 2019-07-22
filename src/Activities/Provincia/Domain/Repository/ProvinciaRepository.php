<?php

declare(strict_types=1);

namespace App\Activities\Provincia\Domain\Repository;

use App\Activities\Provincia\Domain\Provincia;
use App\Shared\ValueObject\Id;

interface ProvinciaRepository
{
    public function byId(Id $id): ?Provincia;

    public function byName(string $name): ?Provincia;

    public function save(Provincia $provincia): void;
}
