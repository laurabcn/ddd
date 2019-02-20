<?php

namespace App\Activities\Shared\ValueObject;

use Colvin\Toolkit\Helper\ValidationHelper;

class Description
{
    private $description;

    /**
     * @param string $description
     */
    public function __construct($description)
    {
        if (!ValidationHelper::isNotEmptyString($description)) {
            throw new \InvalidArgumentException('Description need to be non empty string');
        }

        $this->description = $description;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }
}
