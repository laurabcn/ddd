<?php
declare(strict_types=1);

namespace App\Activities\Application\Provincia\Create;

use App\Activities\Domain\Shared\Bus\Command\Command;

final class CreateProvinciaCommand implements Command
{
    /** @var string  */
    private $id;

    /** @var string */
    private $name;

    /** @var array  */
    private $municipi;

    public function __construct(
        string $id,
        string $name,
        array $municipi
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->municipi = $municipi;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function municipi(): array
    {
        return $this->municipi;
    }
}
