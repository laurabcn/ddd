<?php

declare(strict_types=1);

namespace App\Activities\Application\Activity\Create;

use App\Activities\Domain\Shared\Bus\Command;

final class CreateActivityCommand implements Command
{
    /** @var string  */
    private $id;

    /** @var string */
    private $title;

    /** @var string $startDate */
    private $startDate;

    /** @var string $endDate */
    private $endDate;

    /** @var string $description */
    private $description;

    /** @var string $image */
    private $image;

    /** @var string $url */
    private $url;

    /** @var string $urlGeneral */
    private $urlGeneral;

    /** @var string $email */
    private $email;

    /** @var string $phone */
    private $phone;

    /** @var string $siteId */
    private $siteId;

    /** @var string $price */
    private $price;

    /** @var string duration */
    private $duration;

    /** @var string $type */
    private $type;

    /** @var string $observation */
    private $observation;

    /** @var string $capacity */
    private $capacity;

    /** @var string $inscription */
    private $inscription;

    public function __construct(
        string $id,
        string $title,
        string $startDate,
        string $endDate,
        string $description,
        ?string $image,
        string $url,
        string $urlGeneral,
        ?string $email,
        ?string $phone,
        string $siteId,
        string $price,
        string $duration,
        ?string $type,
        string $observation,
        string $capacity,
        string $inscription
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->description = $description;
        $this->image = $image;
        $this->url = $url;
        $this->urlGeneral = $urlGeneral;
        $this->email = $email;
        $this->phone = $phone;
        $this->siteId = $siteId;
        $this->price = $price;
        $this->duration = $duration;
        $this->type = $type;
        $this->observation = $observation;
        $this->capacity = $capacity;
        $this->inscription = $inscription;

    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function startDate(): string
    {
        return $this->startDate;
    }

    public function endDate(): string
    {
        return $this->endDate;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function urlGeneral(): string
    {
        return $this->urlGeneral;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function phone(): ?string
    {
        return $this->phone;
    }

    public function siteId(): string
    {
        return $this->siteId;
    }

    public function price(): string
    {
        return $this->price;
    }

    public function duration(): string
    {
        return $this->duration;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function observation(): string
    {
        return $this->observation;
    }

    public function capacity(): string
    {
        return $this->capacity;
    }

    public function inscription(): string
    {
        return $this->inscription;
    }

    public function municipiId(): string
    {
        return $this->municipiId;
    }
}
