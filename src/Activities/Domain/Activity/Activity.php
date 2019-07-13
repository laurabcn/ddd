<?php
declare(strict_types=1);

namespace App\Activities\Domain\Activity;

use App\Activities\Application\Activity\Create\ActivityWasCreated;
use App\Activities\Domain\Shared\Aggregate\AggregateRoot;
use App\Activities\Domain\Shared\ValueObject\Id;

class Activity extends AggregateRoot
{
    /** @var Id */
    private $id;
    /** @var string */
    private $acteId;
    /** @var string */
    private $title;
    /** @var \DateTimeInterface */
    private $startDate;
    /** @var \DateTimeInterface */
    private $endDate;
    /** @var string */
    private $language;
    /** @var string */
    private $description;
    /** @var string */
    private $image;
    /** @var string */
    private $url;
    /** @var string */
    private $urlGeneral;
    /** @var string */
    private $email;
    /** @var string */
    private $phone;
    /** @var Id */
    private $site;
    /** @var string */
    private $price;
    /** @var string */
    private $duration;
    /** @var string */
    private $type;
    /** @var string */
    private $observation;
    /** @var string */
    private $capacity;
    /** @var string */
    private $inscription;

    public function __construct(
        Id $id,
        string $acteId,
        string $title,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        string $language,
        ?string $description,
        ?string $image,
        ?string $url,
        ?string $urlGeneral,
        ?string $email,
        ?string $phone,
        ?Id $siteId,
        ?string $price,
        ?string $duration,
        ?string $type,
        ?string $observation,
        ?string $capacity,
        ?string $inscription
    )
    {
        $this->id = $id;
        $this->acteId = $acteId;
        $this->title = $title;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->language = $language;
        $this->description = $description;
        $this->image = $image;
        $this->url = $url;
        $this->urlGeneral = $urlGeneral;
        $this->email = $email;
        $this->phone = $phone;
        $this->site = $siteId;
        $this->price = $price;
        $this->duration = $duration;
        $this->type = $type;
        $this->observation = $observation;
        $this->capacity = $capacity;
        $this->inscription = $inscription;

        $this->recordThat(new ActivityWasCreated($id->id(), $title));
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function acteId(): string
    {
        return $this->acteId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function startDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    public function endDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    public function language(): string
    {
        return $this->language;
    }

    public function description(): ?string
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

    public function site(): Id
    {
        return $this->site;
    }

    public function price(): ?string
    {
        return $this->price;
    }

    public function duration(): ?string
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

    public function capacity(): ?string
    {
        return $this->capacity;
    }

    public function inscription(): ?string
    {
        return $this->inscription;
    }
}

