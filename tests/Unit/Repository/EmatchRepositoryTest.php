<?php

namespace Tests\Entity;

use App\Entity\Ematch;
use PHPUnit\Framework\TestCase;

class EmatchTest extends TestCase
{
    public function testAddAndRemoveScore(): void
    {
        $ematch = new Ematch();

        $score = $this->getMockBuilder('App\Entity\Score')
            ->disableOriginalConstructor()
            ->getMock();

        // Test addScore
        $ematch->addScore($score);
        $this->assertCount(1, $ematch->getScores());

        // Test removeScore
        $ematch->removeScore($score);
        $this->assertCount(0, $ematch->getScores());
    }

    public function testAddAndRemoveTeam(): void
    {
        $ematch = new Ematch();

        $team = $this->getMockBuilder('App\Entity\Team')
            ->disableOriginalConstructor()
            ->getMock();

        // Test addTeam
        $ematch->addTeam($team);
        $this->assertCount(1, $ematch->getTeams());

        // Test removeTeam
        $ematch->removeTeam($team);
        $this->assertCount(0, $ematch->getTeams());
    }
}