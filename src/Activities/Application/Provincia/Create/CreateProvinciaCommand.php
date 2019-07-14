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

    /** @var Id  */
    private $municipiId;

    /** @var string  */
    private $municipiName;

    public function __construct(
        Id $id,
        string $code,
        string $name,
        Id $municipiId,
        string $municipiName
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->municipiId = $municipiId;
        $this->municipiName = $municipiName;
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

    public function municipiId(): Id
    {
        return $this->municipiId;
    }

    public function municipiName(): string
    {
        return $this->municipiName;
    }
}
