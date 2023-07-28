<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Score;
use App\Repository\ScoreRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class ScoreRepositoryTest extends TestCase
{
    private $entityManager;
    private $repository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->repository = new ScoreRepository($this->entityManager);
    }

    public function testSave()
    {
        $score = new Score();
        $score->setTotalPoints(10);

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($score);

        $this->repository->save($score);
    }

    public function testRemove()
    {
        $score = new Score();
        $score->setTotalPoints(10);

        $this->entityManager->expects($this->once())
            ->method('remove')
            ->with($score);

        $this->repository->remove($score);
    }
}
