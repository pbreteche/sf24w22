<?php

namespace App\Tests\Service;

use App\Service\LocaleRegionMapper;
use App\Tests\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class LocaleRegionMapperTest extends KernelTestCase
{
    private LocaleRegionMapper $localeRegionMapper;

    public function setUp(): void
    {
        static::bootKernel();
        $container = static::getContainer();

        $request = new Request();
        $request->setLocale('fr');
        /** @var RequestStack $requestStack */
        $requestStack = $container->get(RequestStack::class);
        $requestStack->push($request);

        $this->localeRegionMapper = $container->get(LocaleRegionMapper::class);
    }

    public function testGetRegion()
    {
        $region = $this->localeRegionMapper->getRegion('fr');
        $this->assertMatchesRegularExpression('#^[A-Z]{2}$#', $region, 'Region should be 2 caps letter');
        $this->assertEquals('FR', $region);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->restoreExceptionHandler();
    }
}
