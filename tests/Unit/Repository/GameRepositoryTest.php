<?php

namespace Tests\Repository;

use App\Entity\Game;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class GameRepositoryUnitTest extends TestCase
{
    private $entityManager;
    private $gameRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->gameRepository = new GameRepository($this->entityManager);
    }

    public function testSave(): void
    {
        $game = new Game();

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($game);

        $this->entityManager->expects($this->once())
            ->method('flush');

        $this->gameRepository->save($game, true);
    }

    public function testRemove(): void
    {
        $game = new Game();

        $this->entityManager->expects($this->once())
            ->method('remove')
            ->with($game);

        $this->entityManager->expects($this->once())
            ->method('flush');

        $this->gameRepository->remove($game, true);
    }
}