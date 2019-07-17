<?php
declare(strict_types=1);

namespace App\Activities\Site\Domain\Repository;

use App\Activities\Site\Domain\Site;
use App\Shared\ValueObject\Id;

interface SiteRepository
{
    public function byId(Id $id): ?Site;

    public function save(Site $site): void;

    public function bySite(string $site): ?Site;
}
