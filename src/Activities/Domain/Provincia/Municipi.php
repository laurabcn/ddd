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
    /** @var string  */
    private $provinciaId;

    public function __construct(string $id, string $name, string $provinciaId)
    {
        $this->id = new Id($id);
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

    public function provinciaId(): string
    {
        return $this->provinciaId;
    }
}