<?php
declare(strict_types=1);

namespace App\Activities\Application\Site\Create;

use App\Activities\Domain\Shared\Bus\Command\Command;
use App\Activities\Domain\Shared\ValueObject\Id;

final class CreateSiteCommand implements Command
{
    /** @var Id  */
    private $id;

    /** @var string */
    private $site;

    /** @var string */
    private $address;

    /** @var string */
    private $postalCode;

    /** @var Id | null */
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
        Id $id,
        string $site,
        ?string $address,
        ?string $postalCode,
        ?Id $municipiId,
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

    public function id(): Id
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

    public function municipiId(): ?Id
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