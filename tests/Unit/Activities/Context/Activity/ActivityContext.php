<?php
declare(strict_types=1);

namespace App\Tests\Unit\Activities\Context\Activity;

use App\Activities\Domain\Activity\Activity;
use App\Tests\Unit\Activities\Core\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin UnitTestCase
 */
trait ActivityContext
{
    protected function aActivityExists(): MockObject
    {
        return $this->createMock(Activity::class);
    }


}