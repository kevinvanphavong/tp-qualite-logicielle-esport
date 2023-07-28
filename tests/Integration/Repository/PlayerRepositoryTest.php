<?php

namespace App\Tests\Integration\Repository;

use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlayerRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSaveAndRemove(): void
    {
        $player = new Player();
        $player->setName('Test Player');

        $this->entityManager->getRepository(Player::class)->save($player);
        $this->assertNotNull($player->getId());

        $this->entityManager->getRepository(Player::class)->remove($player);
        $this->assertNull($this->entityManager->getRepository(Player::class)->find($player->getId()));
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
