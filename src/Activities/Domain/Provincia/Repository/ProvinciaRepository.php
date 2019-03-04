<?php
declare(strict_types=1);

namespace App\Activities\Domain\Provincia\Repository;

use App\Activities\Domain\Provincia\Provincia;
use App\Activities\Domain\Shared\ValueObject\Id;

interface ProvinciaRepository
{
    public function byId(Id $id): ?Provincia;

    public function save(Provincia $provincia): void;
}
