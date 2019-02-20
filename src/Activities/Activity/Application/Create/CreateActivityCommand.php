<?php

declare(strict_types=1);

namespace App\Activities\Activity\Application\Create;

use App\Activities\Shared\Bus\Command;

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

    /** @var array $address */
    private $address;

    /** @var array $municipi */
    private $municipi;

    /** @var array $tags */
    private $tags;

    /** @var string $price */
    private $price;

    /** @var array $category */
    private $category;

    /** @var string duration */
    private $duration;

    /** @var array $types */
    private $types;

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
        string $image,
        string $url,
        string $urlGeneral,
        string $email,
        string $phone,
        array  $address,
        array  $municipi,
        array  $tags,
        string $price,
        array  $category,
        string $duration,
        array  $types,
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
        $this->address = $address;
        $this->municipi = $municipi;
        $this->tags = $tags;
        $this->price = $price;
        $this->category = $category;
        $this->duration = $duration;
        $this->types = $types;
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

    public function image(): string
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

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function address(): array
    {
        return $this->address;
    }

    public function municipi(): array
    {
        return $this->municipi;
    }

    public function tags(): array
    {
        return $this->tags;
    }

    public function price(): string
    {
        return $this->price;
    }

    public function category(): array
    {
        return $this->category;
    }

    public function duration(): string
    {
        return $this->duration;
    }

    public function types(): array
    {
        return $this->types;
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
}
