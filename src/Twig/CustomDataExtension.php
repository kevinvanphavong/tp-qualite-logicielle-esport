<?php

namespace App\Twig;

use App\Entity\Score;
use App\Helper\ScoreDataHelper;
use App\Repository\ScoreRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CustomDataExtension extends AbstractExtension
{
    private ScoreDataHelper $scoreDataHelper;
    public function __construct(ScoreDataHelper $scoreDataHelper)
    {
        $this->scoreDataHelper = $scoreDataHelper;
    }

    public function getFunctions(): array
    {
        return array(
            new TwigFunction('area', array($this, 'calculateArea')),
            new TwigFunction('getName', array($this, 'getName')),
            new TwigFunction('playerScore', array($this, 'playerScore')),
            new TwigFunction('teamScore', array($this, 'teamScore')),
            new TwigFunction('playerScoresData', array($this, 'playerScoresData')),
        );
    }

    public function calculateArea(int $width, int $length)
    {
        return $width * $length;
    }

    public function getName()
    {
        return 'CustomDataExtension';
    }

    public function playerScore($player, $ematch)
    {
        return $this->scoreDataHelper->getPlayerScoreByGame($player, $ematch);
    }

    public function teamScore($team, $ematch)
    {
        return $this->scoreDataHelper->getTeamScoreForTeam($team, $ematch);
    }

    public function playerScoresData($player)
    {
        return $this->scoreDataHelper->getAllScoreDataByPlayer($player);
    }
}

