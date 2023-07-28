<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class PlayerRepositoryTest extends TestCase
{
    private $entityManager;
    private $playerRepository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->playerRepository = new PlayerRepository($this->entityManager);
    }

    public function testSave(): void
    {
        $player = new Player();

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($player);

        $this->entityManager->expects($this->once())
            ->method('flush');

        $this->playerRepository->save($player, true);
    }

    public function testRemove(): void
    {
        $player = new Player();

        $this->entityManager->expects($this->once())
            ->method('remove')
            ->with($player);

        $this->entityManager->expects($this->once())
            ->method('flush');

        $this->playerRepository->remove($player, true);
    }
}
