<?php

namespace App\Tests\Integration\Entity;

use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlayerTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testPlayerInDatabase(): void
    {
        $player = $this->entityManager
            ->getRepository(Player::class)
            ->findOneBy(['name' => 'Test Player']);

        $this->assertSame('Test Player', $player->getName());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
