<?php

declare(strict_types=1);

namespace App\Activities\Activity\Application\Find;


final class FindActivityResponse
{

    /** @var string */
    private $id;

    /** @var string */
    private $title;

    /** @var string | null */
    private $description;

    /** @var string | null */
    private $duration;

    /** @var string */
    private $startDate;

    /** @var string | null */
    private $endDate;

    /** @var string | null */
    private $image;

    /** @var string | null */
    private $inscriptions;

    /** @var string | null*/
    private $observations;

    /** @var string | null */
    private $url;

    /** @var string | null */
    private $urlGeneral;

    /** @var string | null */
    private $type;

    public function __construct(
        string $id,
        string $title,
        ?string $description,
        ?string $duration,
        string $startDate,
        ?string $endDate,
        ?string $image,
        ?string $inscriptions,
        ?string $observations,
        ?string $url,
        ?string $urlGeneral,
        ?string $type
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->duration = $duration;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->image = $image;
        $this->inscriptions = $inscriptions;
        $this->observations = $observations;
        $this->url = $url;
        $this->urlGeneral = $urlGeneral;
        $this->type = $type;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function duration(): ?string
    {
        return $this->duration;
    }

    public function startDate(): string
    {
        return $this->startDate;
    }

    public function endDate(): ?string
    {
        return $this->endDate;
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function inscriptions(): ?string
    {
        return $this->inscriptions;
    }

    public function observations(): ?string
    {
        return $this->observations;
    }

    public function url(): ?string
    {
        return $this->url;
    }

    public function urlGeneral(): ?string
    {
        return $this->urlGeneral;
    }

    public function type(): ?string
    {
        return $this->type;
    }
}