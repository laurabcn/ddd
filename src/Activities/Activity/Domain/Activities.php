<?php

declare(strict_types=1);

namespace App\Activities\Activity\Domain;

use App\Shared\Collection;

final class Activities extends Collection
{
    protected function type(): string
    {
        return Activity::class;
    }
}
