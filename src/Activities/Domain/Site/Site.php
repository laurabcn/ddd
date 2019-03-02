<?php
declare(strict_types=1);

namespace App\Activities\Domain\Site;

use App\Activities\Application\Site\Create\SiteWasCreated;
use App\Activities\Domain\Shared\ValueObject\Id;

class Site
{
    /** @var Id */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $address;
    /** @var string */
    private $postalCode;
    /** @var Id */
    private $municipiId;
    /** @var string */
    private $coordinates;

    public function __construct(
        Id $id,
        string $site,
        string $address,
        string $postalCode,
        Id $municipiId,
        string $coordinates
    ) {
        $this->id = $id;
        $this->name = $site;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->municipiId = $municipiId;
        $this->coordinates = $coordinates;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function site(): string
    {
        return $this->name;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function postalCode(): string
    {
        return $this->postalCode;
    }

    public function municipiId(): Id
    {
        return $this->municipiId;
    }

    public function coordinates(): string
    {
        return $this->coordinates;
    }
}

