<?php

declare(strict_types=1);

namespace App\Activities\Site\Application\Create;

use App\Shared\Bus\Event\Event;

final class SiteWasCreated implements Event
{
    const NAME = 'site.site_created';

    /** @var string */
    private $id;
    /** @var string */
    private $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): string
    {
        return $this->id;
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
     *
     * @return self
     */
    public function fromPayload(array $payload): object
    {
        return new self(
            $payload['id'],
            $payload['name']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
        ];
    }
}
