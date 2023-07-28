<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Score;
use App\Entity\Player;
use App\Entity\Ematch;
use App\Entity\Team;
use PHPUnit\Framework\TestCase;

class ScoreTest extends TestCase
{
    public function testScore(): void
    {
        $score = new Score();

        $this->assertNull($score->getId());

        $player = new Player();
        $score->setPlayer($player);
        $this->assertEquals($player, $score->getPlayer());

        $ematch = new Ematch();
        $score->setEmatch($ematch);
        $this->assertEquals($ematch, $score->getEmatch());

        $score->setTotalPoints(100);
        $this->assertEquals(100, $score->getTotalPoints());

        $score->setNumberKills(10);
        $this->assertEquals(10, $score->getNumberKills());

        $score->setNumberDeaths(5);
        $this->assertEquals(5, $score->getNumberDeaths());

        $score->setNumberAssists(15);
        $this->assertEquals(15, $score->getNumberAssists());

        $team = new Team();
        $score->setTeam($team);
        $this->assertEquals($team, $score->getTeam());
    }
}
