<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlayerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $player = new Player();
            $player->setName('Player '.$i);

            // Create a ref for this player
            $this->setReference('player_'.$i, $player);

            // Create a link between the player and the game
            $player->setGame($this->getReference('game_0'));

            $manager->persist($player);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GameFixtures::class,
        ];
    }
}
