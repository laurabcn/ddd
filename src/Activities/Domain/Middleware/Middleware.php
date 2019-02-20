<?php

declare(strict_types=1);

namespace App\Activities\Domain\Middleware;

final class Middleware
{
    /** @var callable[] */
    private $callables;

    public function __construct(callable ...$callable)
    {
        $this->callables = $callable;
    }

    public function __invoke($argument): void
    {
        $this->nextCallable(0)($argument);
    }

    private function nextCallable($index): callable
    {
        if (!isset($this->callables[$index])) {
            return function () {
            };
        }
        $callable = $this->callables[$index];

        return function ($message) use ($callable, $index) {
            $callable($message, $this->nextCallable($index + 1));
        };
    }
}
