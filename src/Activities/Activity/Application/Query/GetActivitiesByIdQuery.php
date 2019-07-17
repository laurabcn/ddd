<?php

declare(strict_types=1);

namespace Todo\Domain\Todo\Query;

use Shared\Domain\Query\Query;
use Todo\Domain\Todo\TodoId;

final class GetActivitiesByIdQuery implements Query
{
    /** @var Id */
    private $todoId;

    public function __construct(Id $todoId)
    {
        $this->todoId = $todoId;
    }

    public function todoId(): TodoId
    {
        return $this->todoId;
    }
}
