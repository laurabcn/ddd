<?php
declare(strict_types=1);

namespace App\Test\Activities\Application\Activity\Create;

use App\Activities\Application\Site\Create\CreateSiteCommand;
use App\Activities\Application\Site\Create\CreateSiteHandler;
use App\Activities\Domain\Site\Repository\SiteRepository;
use App\Tests\Unit\Activities\Context\Site\SiteContext;
use App\Tests\Unit\Activities\Core\UnitTestCase;

class CreateSiteHandlerTest extends UnitTestCase
{
    use SiteContext;

    /** @var SiteRepository | \PHPUnit_Framework_MockObject_MockObject */
    private $siteRepository;
    /** @var CreateSiteHandler */
    private $createSiteHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->siteRepository = $this->createMock(SiteRepository::class);
        $this->createSiteHandler = new CreateSiteHandler($this->siteRepository);
    }

    /**
     * @test
     */
    public function handleWhenSiteHasData()
    {
        $command = new CreateSiteCommand(
            $this->faker->uuid,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->name,
            $this->faker->url
        );

        $site = $this->aSiteExists();

        $this->siteRepository
            ->expects($this->once())
            ->method('save')
            ->with($site);

        $this->createSiteHandler->handle($command);
    }

    /**
     * @test
     */
    public function handleWhenSiteHasDataWithNull()
    {
        $command = new CreateSiteCommand(
            $this->faker->uuid,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $site = $this->aSiteExists();

        $this->siteRepository
            ->expects($this->once())
            ->method('save')
            ->with($site);

        $this->createSiteHandler->handle($command);
    }
}
