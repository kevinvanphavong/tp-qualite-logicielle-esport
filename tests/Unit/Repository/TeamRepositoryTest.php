<?php

namespace App\Tests\Repository;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class TeamRepositoryUnitTest extends TestCase
{
    private $entityManager;
    private $repository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->repository = new TeamRepository($this->entityManager);
    }

    public function testSave()
    {
        $team = new Team();
        $team->setName('Test Team');

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($team);

        $this->repository->save($team);
    }

    public function testRemove()
    {
        $team = new Team();
        $team->setName('Test Team');

        $this->entityManager->expects($this->once())
            ->method('remove')
            ->with($team);

        $this->repository->remove($team);
    }
}