<?php

namespace App\Tests\Integration\Entity;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testGameInDatabase(): void
    {
        $game = $this->entityManager
            ->getRepository(Game::class)
            ->findOneBy(['name' => 'Test Game']);

        $this->assertSame('Test Game', $game->getName());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
