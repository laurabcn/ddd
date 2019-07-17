<?php

declare(strict_types=1);

namespace App\Activities\Provincia\Application\Create;

use App\Shared\Bus\Event\Event;

final class ProvinciaWasCreated implements  Event
{
    const NAME = 'municipi.municipi_created';

    /** @var string */
    private $id;

    /** @var string */
    private $code;

    /** @var string */
    private $name;

    public function __construct(string $id, string $code, string $name)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }

    public function id(): string
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

    public function messageName(): string
    {
        return self::NAME;
    }

    /**
     * @param array $payload
     * @return self
     */
    public function fromPayload(array $payload): object
    {
        return new self(
            $payload['id'],
            $payload['code'],
            $payload['name']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id(),
            'code' => $this->code(),
            'name' => $this->name(),
        ];
    }
}
