<?php

namespace App\Activities\Shared\ValueObject;

use Colvin\Toolkit\Helper\ValidationHelper;

class Size
{
    /**
     * @var int
     */
    private $size;

    public function __construct(int $size)
    {
        if (!ValidationHelper::isPositiveInteger($size)) {
            throw new \InvalidArgumentException('Invalid value for centimeters, it has to be a positive number');
        }

        $this->size = $size;
    }

    public function size(): int
    {
        return $this->size;
    }
}
