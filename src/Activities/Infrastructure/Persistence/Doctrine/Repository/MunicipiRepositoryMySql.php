<?php

declare(strict_types = 1);

namespace App\Activities\Infrastructure\Persistence\Doctrine\Repository;

use App\Activities\Domain\Municipi\Municipi;
use App\Activities\Domain\Municipi\Repository\MunicipiRepository;
use App\Activities\Domain\Shared\ValueObject\Id;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class MunicipiRepositoryMySql extends ServiceEntityRepository implements MunicipiRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Municipi::class);
    }

    public function save(Municipi $municipi): void
    {
        $this->_em->persist($municipi);
        $this->_em->flush();
    }

    public function byId(Id $id): ?Municipi
    {
        return $this->findOneBy(['id' => $id->id()]);
    }

}
