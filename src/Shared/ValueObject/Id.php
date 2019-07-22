<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

class Id
{
    /** @var string */
    private $id;

    public function __construct(string $id)
    {
        if (!empty($id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException('Invalid uuid format: ' . $id);
        }
    }

    public function id(): string
    {
        return $this->id;
    }

    public function equals(string $id): bool
    {
        return $this->id() === $id;
    }

    public function __toString()
    {
        return $this->id;
    }
}
