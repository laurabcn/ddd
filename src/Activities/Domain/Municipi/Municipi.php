<?php
declare(strict_types=1);

namespace App\Activities\Domain\Municipi;

use App\Activities\Domain\Shared\ValueObject\Id;

class Municipi
{
    /** @var Id */
    private $id;
    /** @var string */
    private $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}