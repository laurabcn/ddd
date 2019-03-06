<?php
declare(strict_types=1);

namespace App\Activities\Domain\Provincia\Repository;

use App\Activities\Domain\Provincia\Provincia;

interface ProvinciaRepository
{
    public function byId(string $id): ?Provincia;

    public function save(Provincia $provincia): void;
}
