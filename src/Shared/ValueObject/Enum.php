<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

use function App\Activities\Toolkit\snake_to_camel;
use function Lambdish\Phunctional\reindex;
use ReflectionClass;

abstract class Enum
{
    protected static $cache = [];
    protected $value;

    public function __construct($value)
    {
        $this->ensureIsBetweenAcceptedValues($value);

        $this->value = $value;
    }

    abstract protected function throwExceptionForInvalidValue($value);

    public static function __callStatic(string $name, $args)
    {
        return new static(self::values()[$name]);
    }

    public static function fromString(string $value)
    {
        return new static($value);
    }

    public static function values(): array
    {
        $class = static::class;

        if (!isset(self::$cache[$class])) {
            $reflected = new ReflectionClass($class);
            self::$cache[$class] = reindex(self::keysFormatter(), $reflected->getConstants());
        }

        return self::$cache[$class];
    }

    public static function randomValue()
    {
        return self::values()[array_rand(self::values())];
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(Enum $other): bool
    {
        return $other === $this;
    }

    private function ensureIsBetweenAcceptedValues($value): void
    {
        if (!\in_array($value, static::values(), true)) {
            $this->throwExceptionForInvalidValue($value);
        }
    }

    public static function random(): self
    {
        return new static(self::randomValue());
    }

    private static function keysFormatter(): callable
    {
        return function ($unused, string $key): string {
            return snake_to_camel(strtolower($key));
        };
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}
