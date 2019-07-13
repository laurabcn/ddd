<?php
declare(strict_types=1);

namespace App\Activities\Domain\Provincia;

use App\Activities\Domain\Shared\ValueObject\Id;

class Municipi
{
    /** @var Id */
    private $id;

    /** @var string */
    private $name;

    /** @var Id  */
    private $provinciaId;

    public function __construct(Id $id, string $name, Id $provinciaId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->provinciaId = $provinciaId;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function provinciaId(): Id
    {
        return $this->provinciaId;
    }
}