<?php
declare(strict_types=1);

namespace App\Tests\Unit\Activities\Context\Site;

use App\Activities\Domain\Shared\ValueObject\Id;
use App\Activities\Domain\Site\Site;
use App\Tests\Unit\Activities\Core\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin UnitTestCase
 */
trait SiteContext
{
    protected function aSiteExists(): MockObject
    {
        return $this->createMock(Site::class);
    }

    protected function theSiteHasId(MockObject $site, Id $id): MockObject
    {
        $site
            ->expects($this->any())
            ->method('id')
            ->willReturn($id);
    }

    protected function theSiteHasName(MockObject $site, string $name): MockObject
    {
        $site
            ->expects($this->any())
            ->method('name')
            ->willReturn($name);
    }

    protected function theSiteHasAddress(MockObject $site, string $address): MockObject
    {
        $site
            ->expects($this->any())
            ->method('address')
            ->willReturn($address);
    }

    protected function theSiteHasPostalCode(MockObject $site, string $postalCode): MockObject
    {
        $site
            ->expects($this->any())
            ->method('postalCode')
            ->willReturn($postalCode);
    }

    protected function theSiteHasMunicipiId(MockObject $site, string $municipiId): MockObject
    {
        $site
            ->expects($this->any())
            ->method('municipiId')
            ->willReturn($municipiId);
    }

    protected function theSiteHasCoordinates(MockObject $site, string $coordinates): MockObject
    {
        $site
            ->expects($this->any())
            ->method('coordinates')
            ->willReturn($coordinates);
    }

    protected function theSiteHasPhone(MockObject $site, string $phone): MockObject
    {
        $site
            ->expects($this->any())
            ->method('phone')
            ->willReturn($phone);
    }

    protected function theSiteHasDescription(MockObject $site, string $description): MockObject
    {
        $site
            ->expects($this->any())
            ->method('description')
            ->willReturn($description);
    }

    protected function theSiteHasUrl(MockObject $site, string $url): MockObject
    {
        $site
            ->expects($this->any())
            ->method('url')
            ->willReturn($url);
    }
}