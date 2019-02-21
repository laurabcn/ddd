<?php
declare(strict_types=1);

namespace App\Activities\Domain\Activity\Repository;

use App\Activities\Domain\Activity\Activity;
use App\Activities\Shared\ValueObject\Id;

interface ActivityRepository
{
    public function byId(Id $id): ?Activity;

    public function save(Activity $recipe): void;
}
