<?php

namespace App\Tests\Entity;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TeamIntegrationTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testTeamInDatabase(): void
    {
        $team = $this->entityManager
            ->getRepository(Team::class)
            ->findOneBy(['name' => 'Test Team']);

        $this->assertSame('Test Team', $team->getName());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}