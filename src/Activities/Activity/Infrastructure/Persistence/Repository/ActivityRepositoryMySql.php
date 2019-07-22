<?php

declare(strict_types=1);

namespace App\Activities\Activity\Infrastructure\Persistence\Repository;

use App\Activities\Activity\Domain\Activity;
use App\Activities\Activity\Domain\Exceptions\ActivityNotFoundException;
use App\Activities\Activity\Domain\Repository\ActivityRepository;
use App\Shared\ValueObject\Id;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class ActivityRepositoryMySql extends ServiceEntityRepository implements ActivityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function save(Activity $activity): void
    {
        $this->_em->persist($activity);
        $this->_em->flush($activity);
    }

    public function byId(Id $id): ?Activity
    {
        return $this->findOneBy(['id' => $id->id()]);
    }

    /**
     * @param Id $id
     *
     * @return Activity
     *
     * @throws ActivityNotFoundException
     */
    public function byIdOrException(Id $id): Activity
    {
        $activity = $this->byId($id);

        if (is_null($activity)) {
            throw new ActivityNotFoundException($id);
        }

        return $activity;
    }

    public function byCode(string $code): ?Activity
    {
        return $this->findOneBy(['acteId' => $code]);
    }

    public function byCodeAndLanguage(string $code, string $language): ?Activity
    {
        return $this->findOneBy(['acteId' => $code, 'language' => $language]);
    }

    public function all(): array
    {
        return $this->findAll();
    }
}
