<?php

declare(strict_types = 1);

namespace App\Activities\Infrastructure\Persistence\Doctrine\Repository;

use App\Activities\Domain\Activity\Activities;
use App\Activities\Domain\Activity\Activity;
use App\Activities\Domain\Activity\Exceptions\ActivityNotFoundException;
use App\Activities\Domain\Activity\Repository\ActivityRepository;
use App\Activities\Domain\Shared\ValueObject\Id;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class ActivityRepositoryMySql extends ServiceEntityRepository  implements ActivityRepository
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

    public function byIdOrException(Id $id): Activity
    {
        $activity =  $this->byId($id);

        if(is_null($activity))
        {
            throw new ActivityNotFoundException('Activity with ' . $id->id());
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