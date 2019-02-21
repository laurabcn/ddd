<?php

declare(strict_types = 1);

namespace App\Activities\Infrastructure\Persistence\Doctrine\Repository;

use App\Activities\Domain\Activity\Activity;
use App\Activities\Domain\Activity\Repository\ActivityRepository;
use App\Activities\Shared\ValueObject\Id;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

final class ActivityRepositoryMySql implements ActivityRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function entityManager(): EntityManager
    {
        return $this->entityManager;
    }

    public function save(Activity $activity): void
    {
        $this->entityManager()->persist($activity);
        $this->entityManager()->flush($activity);
    }

    public function byId(Id $id): ?Activity
    {
        return $this->entityManager->getRepository(Activity::class)->findOneBy(['id' => $id]);
    }

}
