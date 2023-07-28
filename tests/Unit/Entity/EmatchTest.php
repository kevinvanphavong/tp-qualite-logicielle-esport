<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Ematch;
use App\Entity\Game;
use App\Entity\Score;
use App\Entity\Team;
use PHPUnit\Framework\TestCase;

class EmatchTest extends TestCase
{
    public function testEmatch(): void
    {
        $ematch = new Ematch();

        // Test getId
        $this->assertNull($ematch->getId());

        // Test getScores
        $this->assertCount(0, $ematch->getScores());

        // Test addScore
        $score = new Score();
        $ematch->addScore($score);
        $this->assertCount(1, $ematch->getScores());

        // Test removeScore
        $ematch->removeScore($score);
        $this->assertCount(0, $ematch->getScores());

        // Test getGame
        $this->assertNull($ematch->getGame());

        // Test setGame
        $game = new Game();
        $ematch->setGame($game);
        $this->assertEquals($game, $ematch->getGame());

        // Test getTeams
        $this->assertCount(0, $ematch->getTeams());

        // Test addTeam
        $team = new Team();
        $ematch->addTeam($team);
        $this->assertCount(1, $ematch->getTeams());

        // Test removeTeam
        $ematch->removeTeam($team);
        $this->assertCount(0, $ematch->getTeams());
    }
}
