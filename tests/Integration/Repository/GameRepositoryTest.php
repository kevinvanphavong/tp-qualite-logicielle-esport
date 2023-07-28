<?php

namespace Tests\Repository;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameRepositoryTest extends KernelTestCase
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
        $game = new Game();
        $game->setName('Test Game');

        $this->entityManager->getRepository(Game::class)->save($game);
        $this->assertNotNull($game->getId());

        $this->entityManager->getRepository(Game::class)->remove($game);
        $this->assertNull($this->entityManager->getRepository(Game::class)->find($game->getId()));
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}