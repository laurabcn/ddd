<?php
declare(strict_types=1);

namespace App\Tests\Unit\Activities\Context\Provincia;

use App\Activities\Domain\Activity\Activity;
use App\Activities\Domain\Provincia\Municipi;
use App\Activities\Domain\Provincia\Provincia;
use App\Activities\Domain\Shared\ValueObject\Id;
use App\Tests\Unit\Activities\Core\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin UnitTestCase
 */
trait ProvinciaContext
{
    protected function aProvinciaExists(): MockObject
    {
        return $this->createMock(Provincia::class);
    }

    protected function theProvinciaHasId(MockObject $provincia, Id $id): MockObject
    {
        $provincia
            ->expects($this->any())
            ->method('id')
            ->willReturn($id);
    }

    protected function theProvinciaHasName(MockObject $provincia, string $name): MockObject
    {
        $provincia
            ->expects($this->any())
            ->method('name')
            ->willReturn($name);
    }

    protected function theProvinciaHasMunicipi(MockObject $provincia, Municipi $municipi): MockObject
    {
        $provincia
            ->expects($this->any())
            ->method('municipi')
            ->willReturn([$municipi]);
    }

    protected function theProvinciaRegisterMunicipi(MockObject $provincia, Municipi $municipi): MockObject
    {
        $provincia
            ->expects($this->any())
            ->method('registerMunicipi')
            ->with(new Id($municipi->id()->id()), $municipi->name());
    }

}