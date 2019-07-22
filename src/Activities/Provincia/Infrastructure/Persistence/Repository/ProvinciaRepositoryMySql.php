<?php

declare(strict_types=1);

namespace App\Activities\Provincia\Infrastructure\Persistence\Repository;

use App\Activities\Provincia\Domain\Provincia;
use App\Activities\Provincia\Domain\Repository\ProvinciaRepository;
use App\Shared\ValueObject\Id;
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

    public function byName(string $name): ?Provincia
    {
        return $this->findOneBy(['name' => $name]);
    }
}
