<?php

namespace Tests\Repository;

use App\Entity\Ematch;
use App\Repository\EmatchRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmatchRepositoryTest extends KernelTestCase
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
        $ematch = new Ematch();

        /** @var EmatchRepository $ematchRepository */
        $ematchRepository = $this->entityManager->getRepository(Ematch::class);

        // Test save
        $ematchRepository->save($ematch);
        $this->assertNotNull($ematch->getId());

        // Test remove
        $ematchRepository->remove($ematch);
        $this->entityManager->clear();

        $ematch = $ematchRepository->find($ematch->getId());
        $this->assertNull($ematch);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}