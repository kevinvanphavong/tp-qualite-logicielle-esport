<?php

namespace App\Helper;

use App\Entity\Ematch;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Score;
use App\Entity\Team;
use App\Repository\ScoreRepository;

class ScoreDataHelper
{
    private ScoreRepository $scoreRepository;
    public function __construct(\App\Repository\ScoreRepository $scoreRepository)
    {
        $this->scoreRepository = $scoreRepository;
    }

    public function getPlayerScoreByGame(Player $player, Ematch $ematch)
    {
        return $this->scoreRepository->findOneBy(['player' => $player, 'ematch' => $ematch]);
    }
    public function getTeamScoreForTeam(Team $team, Ematch $ematch)
    {
        $finalScore = [
            Score::SCORE_ATTRIBUTES[0] => 0,
            Score::SCORE_ATTRIBUTES[1] => 0,
            Score::SCORE_ATTRIBUTES[2] => 0,
            Score::SCORE_ATTRIBUTES[3] => 0,
        ];

        foreach ($team->getPlayers() as $player) {
            $playerScore = $this->getPlayerScoreByGame($player, $ematch);
            if ($playerScore) {
                $finalScore[Score::SCORE_ATTRIBUTES[0]] += $playerScore->getNumberKills();
                $finalScore[Score::SCORE_ATTRIBUTES[1]] += $playerScore->getNumberDeaths();
                $finalScore[Score::SCORE_ATTRIBUTES[2]] += $playerScore->getNumberAssists();
                $finalScore[Score::SCORE_ATTRIBUTES[3]] += $playerScore->getTotalPoints();
            }
        }

        return $finalScore;
    }

    public function updateTeamScore(Game $game, Ematch $ematch)
    {
        $teams = $ematch->getTeams();

        foreach ($teams as $team) {
            $teamScore = $this->getTeamScoreForTeam($team, $ematch);

            // Vérifier si $team->getScore() existe
            $score = $this->scoreRepository->findOneBy(['team' => $team->getId(), 'ematch' => $ematch->getId()]);
            // Si oui, on met à jour les données avec updateTeamScore
            if($score != null) {
                $score->setNumberKills($teamScore[Score::SCORE_ATTRIBUTES[0]]);
                $score->setNumberDeaths($teamScore[Score::SCORE_ATTRIBUTES[1]]);
                $score->setNumberAssists($teamScore[Score::SCORE_ATTRIBUTES[2]]);
                $score->setTotalPoints($teamScore[Score::SCORE_ATTRIBUTES[3]]);
            // Sinon, on crée un nouveau score pour l'équipe avec setTeamScore
            } else {
                $this->setNewTeamScore($team, $ematch, $teamScore);
            }
        }
    }

    public function setNewTeamScore(Team $team, Ematch $ematch, array $teamScore)
    {
        $score = new Score();
        $score->setNumberKills($teamScore[Score::SCORE_ATTRIBUTES[0]]);
        $score->setNumberDeaths($teamScore[Score::SCORE_ATTRIBUTES[1]]);
        $score->setNumberAssists($teamScore[Score::SCORE_ATTRIBUTES[2]]);
        $score->setTotalPoints($teamScore[Score::SCORE_ATTRIBUTES[3]]);
        $score->setTeam($team);
        $score->setEmatch($ematch);
        $team->addScore($score);
        $this->scoreRepository->save($score, true);
    }

    public function getAllScoreDataByPlayer($player)
    {
        $scores = $player->getScores();

        $scoresData = [
            Score::SCORE_ATTRIBUTES[0] => 0,
            Score::SCORE_ATTRIBUTES[1] => 0,
            Score::SCORE_ATTRIBUTES[2] => 0,
            Score::SCORE_ATTRIBUTES[3] => 0,
        ];

        foreach ($scores as $score) {
            $scoresData[Score::SCORE_ATTRIBUTES[0]] += $score->getNumberKills();
            $scoresData[Score::SCORE_ATTRIBUTES[1]] += $score->getNumberDeaths();
            $scoresData[Score::SCORE_ATTRIBUTES[2]] += $score->getNumberAssists();
            $scoresData[Score::SCORE_ATTRIBUTES[3]] += $score->getTotalPoints();
        }

        return $scoresData;
    }
}
