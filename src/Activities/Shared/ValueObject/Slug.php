<?php

namespace App\Activities\Shared\ValueObject;

use Colvin\Toolkit\Helper\ValidationHelper;

class Slug
{
    private $slug;

    /**
     * @param string $slug
     */
    public function __construct($slug)
    {
        if (!ValidationHelper::isValidSlug($slug)) {
            throw new \InvalidArgumentException('Slug must be a string with no spaces');
        }

        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function slug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->slug;
    }
}
