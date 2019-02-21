<?php

declare(strict_types = 1);

namespace App\Activities\Infrastructure\Persistence\Doctrine\Repository;

use App\Activities\Domain\Municipi\Municipi;
use App\Activities\Domain\Municipi\Repository\MunicipiRepository;
use App\Activities\Shared\ValueObject\Id;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

final class MunicipiRepositoryMySql implements MunicipiRepository
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

    public function save(Municipi $municipi): void
    {
        $this->entityManager()->persist($municipi);
        $this->entityManager()->flush($municipi);
    }

    public function byId(Id $id): ?Municipi
    {
        return $this->entityManager->getRepository(Municipi::class)->findOneBy(['id' => $id]);
    }

}
