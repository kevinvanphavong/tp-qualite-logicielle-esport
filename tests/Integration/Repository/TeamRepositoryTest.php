<?php

namespace App\Tests\Integration\Repository;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TeamRepositoryTest extends KernelTestCase
{
    private $entityManager;
    private $repository;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->entityManager = self::$container->get(EntityManager::class);
        $this->repository = self::$container->get(TeamRepository::class);
    }

    public function testSaveAndRemove()
    {
        $team = new Team();
        $team->setName('Test Team');

        // Save the team
        $this->repository->save($team, true);

        // Check that the team was saved
        $savedTeam = $this->repository->find($team->getId());
        $this->assertNotNull($savedTeam);
        $this->assertEquals('Test Team', $savedTeam->getName());

        // Remove the team
        $this->repository->remove($team, true);

        // Check that the team was removed
        $removedTeam = $this->repository->find($team->getId());
        $this->assertNull($removedTeam);
    }
}
