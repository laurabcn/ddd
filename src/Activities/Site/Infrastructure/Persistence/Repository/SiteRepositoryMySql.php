<?php

declare(strict_types=1);

namespace App\Activities\Site\Infrastructure\Persistence\Repository;

use App\Activities\Site\Domain\Repository\SiteRepository;
use App\Activities\Site\Domain\Site;
use App\Shared\ValueObject\Id;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class SiteRepositoryMySql extends ServiceEntityRepository implements SiteRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Site::class);
    }

    public function save(Site $site): void
    {
        $this->_em->persist($site);
        $this->_em->flush();
    }

    public function byId(Id $id): ?Site
    {
        return $this->findOneBy(['id' => $id->id()]);
    }

    public function bySite(string $site): ?Site
    {
        return $this->findOneBy(['name' => $site]);
    }
}
