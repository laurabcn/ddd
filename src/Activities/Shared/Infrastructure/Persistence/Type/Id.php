<?php

declare(strict_types=1);

namespace App\Activities\Shared\Infrastructure\Persistence\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class Id extends GuidType
{
    const MYTYPE = 'Id';
    const NAMESPACE = 'App\Activities\Domain\Shared\ValueObject';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (is_null($value)) {
            return null;
        }
        $className = $this->getNamespace() . '\\' . $this->getName();

        return new $className($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (is_scalar($value)) {
            return $value;
        }

        if (null !== $value) {
            return $value->id();
        }

        return null;
    }

    public function getName()
    {
        return self::MYTYPE; // modify to match your constant name
    }

    protected function getNamespace()
    {
        return self::NAMESPACE;
    }
}
