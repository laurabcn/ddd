<?php
declare(strict_types=1);

namespace App\Activities\Domain\Municipi\Repository;

use App\Activities\Domain\Municipi\Municipi;
use App\Activities\Domain\Shared\ValueObject\Id;

interface MunicipiRepository
{
    public function byId(Id $id): ?Municipi;

    public function save(Municipi $municipi): void;
}
