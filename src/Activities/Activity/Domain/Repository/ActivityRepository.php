<?php
declare(strict_types=1);

namespace App\Activities\Activity\Domain\Repository;

use App\Activities\Activity\Domain\Activity;
use App\Activities\Shared\ValueObject\Id;

interface ActivityRepository
{
    public function byId(Id $id): ?Activity;

    public function save(Activity $recipe): void;
}
