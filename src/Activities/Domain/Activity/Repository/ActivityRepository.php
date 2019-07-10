<?php
declare(strict_types=1);

namespace App\Activities\Domain\Activity\Repository;

use App\Activities\Domain\Activity\Activity;
use App\Activities\Domain\Shared\ValueObject\Id;

interface ActivityRepository
{
    public function byId(Id $id): ?Activity;

    public function byIdOrException(Id $id): Activity;

    public function byCode(string $code): ?Activity;

    public function byCodeAndLanguage(string $code, string $language): ?Activity;

    public function all(): array;

    public function save(Activity $activity): void;

}
