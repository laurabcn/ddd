<?php
declare(strict_types=1);

namespace App\Activities\Domain\Site\Repository;

use App\Activities\Domain\Shared\ValueObject\Id;
use App\Activities\Domain\Site\Site;

interface SiteRepository
{
    public function byId(Id $id): ?Site;

    public function save(Site $site): void;

    public function bySite(string $site): ?Site;
}
