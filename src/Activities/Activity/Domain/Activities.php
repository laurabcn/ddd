<?php
declare(strict_types=1);

namespace App\Activities\Domain\Activity;

use App\Activities\Domain\Shared\Collection;

final class Activities extends Collection
{
    protected function type(): string
    {
        return Activity::class;
    }
}
