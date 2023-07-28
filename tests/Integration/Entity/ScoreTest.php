<?php

namespace App\Tests\Entity;

use App\Entity\Score;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ScoreIntegrationTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testScoreInDatabase(): void
    {
        $score = $this->entityManager
            ->getRepository(Score::class)
            ->findOneBy(['totalPoints' => 100]);

        $this->assertSame(100, $score->getTotalPoints());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}