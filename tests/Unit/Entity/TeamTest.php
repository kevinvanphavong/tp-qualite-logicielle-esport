<?php

namespace App\Tests\Entity;

use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Game;
use App\Entity\Ematch;
use App\Entity\Score;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    public function testTeam(): void
    {
        $team = new Team();

        $this->assertNull($team->getId());

        $team->setName('Test Team');
        $this->assertEquals('Test Team', $team->getName());

        $player = new Player();
        $team->addPlayer($player);
        $this->assertCount(1, $team->getPlayers());

        $team->removePlayer($player);
        $this->assertCount(0, $team->getPlayers());

        $game = new Game();
        $team->setGame($game);
        $this->assertEquals($game, $team->getGame());

        $ematch = new Ematch();
        $team->addEmatch($ematch);
        $this->assertCount(1, $team->getEmatches());

        $team->removeEmatch($ematch);
        $this->assertCount(0, $team->getEmatches());

        $score = new Score();
        $team->addScore($score);
        $this->assertCount(1, $team->getScores());

        $team->removeScore($score);
        $this->assertCount(0, $team->getScores());
    }
}