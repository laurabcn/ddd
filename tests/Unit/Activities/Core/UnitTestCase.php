<?php

namespace App\Tests\Unit\Activities\Core;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    /**
     * @var Generator
     */
    protected $faker;

    protected function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create();
    }
}
