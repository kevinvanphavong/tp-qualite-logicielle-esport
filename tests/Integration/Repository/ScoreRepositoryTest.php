<?php

namespace App\Tests\Integration\Repository;

use App\Entity\Score;
use App\Repository\ScoreRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ScoreRepositoryTest extends KernelTestCase
{
    private $entityManager;
    private $repository;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->entityManager = self::$container->get(EntityManager::class);
        $this->repository = self::$container->get(ScoreRepository::class);
    }

    public function testSaveAndRemove()
    {
        $score = new Score();
        $score->setTotalPoints(10);

        // Save the score
        $this->repository->save($score, true);

        // Check that the score was saved
        $savedScore = $this->repository->find($score->getId());
        $this->assertNotNull($savedScore);
        $this->assertEquals(10, $savedScore->getTotalPoints());

        // Remove the score
        $this->repository->remove($score, true);

        // Check that the score was removed
        $removedScore = $this->repository->find($score->getId());
        $this->assertNull($removedScore);
    }
}
