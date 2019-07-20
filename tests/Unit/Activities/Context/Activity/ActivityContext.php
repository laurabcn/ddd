<?php

declare(strict_types=1);

namespace App\Tests\Unit\Activities\Context\Activity;

use App\Activities\Activity\Domain\Activity;
use App\Shared\ValueObject\Id;
use App\Tests\Unit\Activities\Core\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin UnitTestCase
 */
trait ActivityContext
{
    protected function anActivityExists(): MockObject
    {
        return $this->createMock(Activity::class);
    }

    protected function theActivityHasId(MockObject $activity, Id $id): void
    {
        $activity
            ->expects($this->any())
            ->method('id')
            ->willReturn($id);
    }

    protected function theActivityHasTitle(MockObject $activity, string $title): void
    {
        $activity
            ->expects($this->any())
            ->method('title')
            ->willReturn($title);
    }

    protected function theActivityHasDescription(MockObject $activity, ?string $description = null): void
    {
        $activity
            ->expects($this->any())
            ->method('description')
            ->willReturn($description);
    }

    protected function theActivityHasDuration(MockObject $activity, ?string $duration = null): void
    {
        $activity
            ->expects($this->any())
            ->method('duration')
            ->willReturn($duration);
    }

    protected function theActivityHasStartDate(MockObject $activity, \DateTime $startDate = null): void
    {
        $activity
            ->expects($this->any())
            ->method('startDate')
            ->willReturn($startDate);
    }

    protected function theActivityHasEndDate(MockObject $activity, ?\DateTime $endDate = null): void
    {
        $activity
            ->expects($this->any())
            ->method('endDate')
            ->willReturn($endDate);
    }

    protected function theActivityHasImage(MockObject $activity, ?string $image = null): void
    {
        $activity
            ->expects($this->any())
            ->method('image')
            ->willReturn($image);
    }

    protected function theActivityHasInscription(MockObject $activity, ?string $inscription = null): void
    {
        $activity
            ->expects($this->any())
            ->method('inscription')
            ->willReturn($inscription);
    }

    protected function theActivityHasObservation(MockObject $activity, ?string $observation = null): void
    {
        $activity
            ->expects($this->any())
            ->method('observation')
            ->willReturn($observation);
    }

    protected function theActivityHasUrl(MockObject $activity, ?string $url = null): void
    {
        $activity
            ->expects($this->any())
            ->method('url')
            ->willReturn($url);
    }

    protected function theActivityHasUrlGeneral(MockObject $activity, ?string $urlGeneral = null): void
    {
        $activity
            ->expects($this->any())
            ->method('urlGeneral')
            ->willReturn($urlGeneral);
    }

    protected function theActivityHasType(MockObject $activity, ?string $type = null): void
    {
        $activity
            ->expects($this->any())
            ->method('type')
            ->willReturn($type);
    }
}