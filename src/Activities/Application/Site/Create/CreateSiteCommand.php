<?php
declare(strict_types=1);

namespace App\Activities\Application\Site\Create;

use App\Activities\Domain\Shared\Bus\Command;

final class CreateSiteCommand implements Command
{
    /** @var string  */
    private $id;

    /** @var string */
    private $site;

    /** @var string */
    private $address;

    /** @var string */
    private $postalCode;

    /** @var string */
    private $municipiId;

    /** @var string */
    private $coordinates;

    /** @var string */
    private $phone;

    /** @var string */
    private $description;

    /** @var string */
    private $url;

    public function __construct(
        string $id,
        string $site,
        ?string $address,
        ?string $postalCode,
        ?string $municipiId,
        ?string $coordinates,
        ?string $phone,
        ?string $description,
        ?string $url
    ) {
        $this->id = $id;
        $this->site = $site;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->municipiId = $municipiId;
        $this->coordinates = $coordinates;
        $this->phone = $phone;
        $this->description = $description;
        $this->url = $url;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function site(): string
    {
        return $this->site;
    }

    public function address(): ?string
    {
        return $this->address;
    }

    public function postalCode(): ?string
    {
        return $this->postalCode;
    }

    public function municipiId(): ?string
    {
        return $this->municipiId;
    }

    public function coordinates(): ?string
    {
        return $this->coordinates;
    }

    public function phone(): ?string
    {
        return $this->phone;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function url(): ?string
    {
        return $this->url;
    }
}