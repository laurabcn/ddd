<?php

declare(strict_types = 1);

namespace App\Activities\Infrastructure\Persistence\Doctrine\Repository;

use App\Activities\Domain\Activity\Activities;
use App\Activities\Domain\Activity\Activity;
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
        $expression = Criteria::expr();
        $expression->eq('id', $id);

        $find = $this->searchByCriteria($expression);

        return $find[0];
    }

    public function byCode(string $code): ?Activity
    {
        $expression = Criteria::expr();
        $find = $this->searchByCriteria($expression->eq('activityId', $code));

        return $find[0];
    }

    public function byCodeAndLanguage(string $code, string $language): ?Activity
    {
        $expression = Criteria::expr();

        $find = $this->searchByCriteria($expression->andX(
            $expression->eq('activityId', $code),
            $expression->eq('language', $language)
            )
        );

        return $find[0];
    }

    public function searchByCriteria($expression,  array $order = null): Activities
    {
        $criteria = new Criteria();
        $criteria->where($expression);
        
        if(empty($order))
        {
            $criteria->orderBy(['id', 'DESC']);
        }
        else{
            foreach ($order as $key => $value) {
                $criteria->orderBy([$key . ',' . $value]);
            }
        }

        $result = $this->_em->getRepository(Activity::class)->matching($criteria);

        return $result->isEmpty() ? null : new Activities($result->toArray());
    }
}