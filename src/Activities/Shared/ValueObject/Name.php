<?php

namespace App\Activities\Shared\ValueObject;

use Colvin\Toolkit\Helper\ValidationHelper;

class Name
{
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        if (!ValidationHelper::isNotEmptyString($name)) {
            throw new \InvalidArgumentException('Name need to be non empty string');
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
