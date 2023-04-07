<?php

namespace App\DataFixtures;

use App\Entity\Ematch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EmatchFixtures extends Fixture implements DependentFixtureInterface
{
    public function createEmatches()
    {
        $ematch1 = new Ematch();
        $ematch2 = new Ematch();
        $ematch3 = new Ematch();
        $ematch4 = new Ematch();
        $ematch5 = new Ematch();

        $ematch1->setGame($this->getReference('game_0'));
        $ematch2->setGame($this->getReference('game_0'));
        $ematch3->setGame($this->getReference('game_0'));
        $ematch4->setGame($this->getReference('game_0'));
        $ematch5->setGame($this->getReference('game_0'));

        return [$ematch1, $ematch2, $ematch3, $ematch4, $ematch5];
    }

    public function load(ObjectManager $manager): void
    {
        $loopIndex = 0;
        foreach ($this->createEmatches() as $ematch) {

            if($loopIndex % 2) {
                $ematch->addTeam($this->getReference('team_1'));
                $ematch->addTeam($this->getReference('team_2'));
            }
            $ematch->addTeam($this->getReference('team_3'));
            $ematch->addTeam($this->getReference('team_4'));
            $ematch->addTeam($this->getReference('team_5'));

            $loopIndex++;
            $manager->persist($ematch);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TeamFixtures::class,
        ];
    }
}
