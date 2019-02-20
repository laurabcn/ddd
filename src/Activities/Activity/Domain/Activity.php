<?php

namespace App\Activities\Activity\Domain;

use App\Activities\Activity\Application\Create\ActivityWasCreated;
use App\Activities\Shared\Aggregate\AggregateRoot;

class Activity extends AggregateRoot
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;

    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;

        $this->recordThat(new ActivityWasCreated($id, $title));
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }
}

