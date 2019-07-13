<?php
declare(strict_types=1);

namespace App\Activities\Domain\Provincia;

use App\Activities\Domain\Shared\Aggregate\AggregateRoot;
use App\Activities\Domain\Shared\ValueObject\Id;
use Doctrine\Common\Collections\ArrayCollection;

class Provincia extends AggregateRoot
{
    /** @var Id */
    private $id;

    /** @var string */
    private $code;

    /** @var string */
    private $name;

    /** @var Municipi[]|ArrayCollection */
    private $municipi;

    public function __construct(Id $id, string $code, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->municipi = new ArrayCollection();
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function municipi()
    {
        return $this->municipi;
    }

    public function registerMunicipi(Id $municipiId, string $name)
    {
        $municipi = new Municipi(
            $municipiId,
            $name,
            $this->id()
        );

        $this->addMunicipi($municipi);
    }

    public function addMunicipi(Municipi $municipi): void
    {
        $this->municipi[] = $municipi;
    }

    public function getMunicipiById(Id $municipiId)
    {
        return $this->municipi->get($municipiId->id());
    }

    public function getMunicipiByName(string $municipi): ?Municipi
    {
        foreach ($this->municipi() as $item) {
            if($item->name() === $municipi){
                return $item;
            }
        };
        return null;
    }

    public function hasMunicipi(string $municipi): bool
    {
        $this->municipi->filter( function($entry) use ($municipi) {
            return $entry->name() === $municipi;
        });
        return false;
    }
}