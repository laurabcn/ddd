<?php

declare(strict_types = 1);

namespace App\Activities\Infrastructure\Persistence\Doctrine\Repository;

use App\Activities\Domain\Provincia\Provincia;
use App\Activities\Domain\Provincia\Repository\ProvinciaRepository;
use App\Activities\Domain\Shared\ValueObject\Id;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class ProvinciaRepositoryMySql extends ServiceEntityRepository implements ProvinciaRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Provincia::class);
    }

    public function save(Provincia $provincia): void
    {
        $this->_em->persist($provincia);
        $this->_em->flush();
    }

    public function byId(Id $id): ?Provincia
    {
        return $this->findOneBy(['id' => $id->id()]);
    }

}
