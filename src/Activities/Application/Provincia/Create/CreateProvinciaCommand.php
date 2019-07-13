<?php
declare(strict_types=1);

namespace App\Activities\Application\Provincia\Create;

use App\Activities\Domain\Shared\Bus\Command\Command;
use App\Activities\Domain\Shared\ValueObject\Id;

final class CreateProvinciaCommand implements Command
{
    /** @var Id  */
    private $id;

    /** @var string */
    private $code;

    /** @var string */
    private $name;

    /** @var array  */
    private $municipi;

    public function __construct(
        Id $id,
        string $code,
        string $name,
        array $municipi
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->municipi = $municipi;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function municipi(): array
    {
        return $this->municipi;
    }
}
