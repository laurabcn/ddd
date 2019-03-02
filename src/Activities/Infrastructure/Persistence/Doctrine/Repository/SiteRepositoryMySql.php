<?php

declare(strict_types = 1);

namespace App\Activities\Infrastructure\Persistence\Doctrine\Repository;

use App\Activities\Domain\Site\Repository\SiteRepository;
use App\Activities\Domain\Site\Site;
use App\Activities\Shared\ValueObject\Id;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

final class SiteRepositoryMySql implements SiteRepository
{
    /** @var EntityManager */
    private $entityManager;

    /** @param EntityManager $entityManager */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function entityManager(): EntityManager
    {
        return $this->entityManager;
    }

    public function save(Site $site): void
    {
        $this->entityManager()->persist($site);
        $this->entityManager()->flush($site);
    }

    public function byId(Id $id): ?Site
    {
        return $this->entityManager->getRepository(Site::class)->findOneBy(['id' => $id]);
    }

}
