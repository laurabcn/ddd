<?php
declare(strict_types=1);

namespace App\Test\Activities\Site\Application\Create;

use App\Activities\Site\Application\Create\CreateSiteCommand;
use App\Activities\Site\Application\Create\CreateSiteHandler;
use App\Activities\Site\Domain\Repository\SiteRepository;
use App\Activities\Site\Domain\Site;
use App\Shared\ValueObject\Id;
use App\Tests\Unit\Activities\Context\Site\SiteContext;
use App\Tests\Unit\Activities\Core\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CreateSiteHandlerTest extends UnitTestCase
{
    use SiteContext;

    /** @var SiteRepository | MockObject */
    private $siteRepository;
    /** @var CreateSiteHandler */
    private $createSiteHandler;

    protected function setUp(): void
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
            $idSite =  new Id($this->faker->uuid),
            $siteName = $this->faker->name,
            $address = $this->faker->address,
            $postalCode = (string) $this->faker->randomNumber(5),
            $municipiId = new Id($this->faker->name),
            $coordinates = $this->faker->name,
            $phoneNumber = (string) $this->faker->randomNumber(9),
            $description = $this->faker->text,
            $url = $this->faker->url
        );

        $site = new Site(
            $idSite,
            $siteName,
            $address,
            $postalCode,
            $municipiId,
            $coordinates,
            $phoneNumber,
            $description,
            $url
        );

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
            $idSite = new Id($this->faker->uuid),
            $siteName = $this->faker->name,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $site = new Site(
            $idSite,
            $siteName,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $this->siteRepository
            ->expects($this->once())
            ->method('save')
            ->with($site);

        $this->createSiteHandler->handle($command);
    }
}
