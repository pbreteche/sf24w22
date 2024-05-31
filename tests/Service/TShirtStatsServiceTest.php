<?php

namespace App\Tests\Service;

use App\DataFixtures\TShirtFixtures;
use App\Service\TShirtStatsService;
use App\Tests\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class TShirtStatsServiceTest extends KernelTestCase
{
    private TShirtStatsService $service;
    protected AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->service = $container->get(TShirtStatsService::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testGetStats()
    {
        $this->databaseTool->loadFixtures([
            TShirtFixtures::class
        ]);
        $result = $this->service->getStats();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->databaseTool);
        $this->restoreExceptionHandler();
    }
}
