<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture
{
    private $gameDataFixtures = [
        [
            'name' => 'League of Legends',
        ],
        [
            'name' => 'Call of Duty : Black Ops 2',
        ],
        [
            'name' => 'FIFA 2023',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $loopIndex = 0;

        foreach ($this->gameDataFixtures as $gameData) {
            $game = new Game();
            $game->setName($gameData['name']);

            $this->addReference('game_'.$loopIndex, $game);
            $loopIndex++;

            $manager->persist($game);
        }

        $manager->flush();
    }
}
