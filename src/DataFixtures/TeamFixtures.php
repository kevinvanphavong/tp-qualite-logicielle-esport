<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $loopIndex = 1;

        $team1 = new Team();
        $team2 = new Team();
        $team3 = new Team();
        $team4 = new Team();
        $team5 = new Team();

        $team1->setName('Team 1');
        $team2->setName('Team 2');
        $team3->setName('Team 3');
        $team4->setName('Team 4');
        $team5->setName('Team 5');

        $team1->setGame($this->getReference('game_0'));
        $team2->setGame($this->getReference('game_0'));
        $team3->setGame($this->getReference('game_0'));
        $team4->setGame($this->getReference('game_0'));
        $team5->setGame($this->getReference('game_0'));

        // Create a ref for this player
        $this->setReference('team_1', $team1);
        $this->setReference('team_2', $team2);
        $this->setReference('team_3', $team3);
        $this->setReference('team_4', $team4);
        $this->setReference('team_5', $team5);

        // Create a link between the player and the game
        $team1->addPlayer($this->getReference('player_1'));
        $team1->addPlayer($this->getReference('player_2'));
        $team1->addPlayer($this->getReference('player_3'));
        $team1->addPlayer($this->getReference('player_4'));
        $team2->addPlayer($this->getReference('player_5'));
        $team2->addPlayer($this->getReference('player_6'));
        $team2->addPlayer($this->getReference('player_7'));
        $team2->addPlayer($this->getReference('player_8'));
        $team3->addPlayer($this->getReference('player_9'));
        $team3->addPlayer($this->getReference('player_10'));
        $team3->addPlayer($this->getReference('player_11'));
        $team3->addPlayer($this->getReference('player_12'));
        $team4->addPlayer($this->getReference('player_13'));
        $team4->addPlayer($this->getReference('player_14'));
        $team4->addPlayer($this->getReference('player_15'));
        $team4->addPlayer($this->getReference('player_16'));
        $team5->addPlayer($this->getReference('player_17'));
        $team5->addPlayer($this->getReference('player_18'));
        $team5->addPlayer($this->getReference('player_19'));
        $team5->addPlayer($this->getReference('player_20'));

        $loopIndex++;
        $manager->persist($team1);
        $manager->persist($team2);
        $manager->persist($team3);
        $manager->persist($team4);
        $manager->persist($team5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PlayerFixtures::class,
        ];
    }
}
