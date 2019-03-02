<?php
declare(strict_types=1);

namespace App\Activities\Domain\Site\Repository;

use App\Activities\Domain\Site\Site;
use App\Activities\Shared\ValueObject\Id;

interface SiteRepository
{
    public function byId(Id $id): ?Site;

    public function save(Site $site): void;
}
