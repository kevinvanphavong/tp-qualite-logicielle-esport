<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Player;
use App\Entity\Game;
use App\Entity\Team;
use App\Entity\Score;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testPlayer(): void
    {
        $player = new Player();

        $this->assertNull($player->getId());

        $player->setName('Test Player');
        $this->assertEquals('Test Player', $player->getName());

        $game = new Game();
        $player->setGame($game);
        $this->assertEquals($game, $player->getGame());

        $team = new Team();
        $player->setTeam($team);
        $this->assertEquals($team, $player->getTeam());

        $score = new Score();
        $player->addScore($score);
        $this->assertCount(1, $player->getScores());

        $player->removeScore($score);
        $this->assertCount(0, $player->getScores());
    }
}
