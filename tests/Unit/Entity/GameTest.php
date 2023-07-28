<?php

namespace App\Tests\Entity;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Team;
use App\Entity\Ematch;
use PHPUnit\Framework\TestCase;

class GameUnitTest extends TestCase
{
    public function testGame(): void
    {
        $game = new Game();

        $this->assertNull($game->getId());

        $game->setName('Test Game');
        $this->assertEquals('Test Game', $game->getName());

        $player = new Player();
        $game->addPlayer($player);
        $this->assertCount(1, $game->getPlayers());

        $game->removePlayer($player);
        $this->assertCount(0, $game->getPlayers());

        $team = new Team();
        $game->addTeam($team);
        $this->assertCount(1, $game->getTeams());

        $game->removeTeam($team);
        $this->assertCount(0, $game->getTeams());

        $ematch = new Ematch();
        $game->addEmatch($ematch);
        $this->assertCount(1, $game->getEmatches());

        $game->removeEmatch($ematch);
        $this->assertCount(0, $game->getEmatches());
    }
}