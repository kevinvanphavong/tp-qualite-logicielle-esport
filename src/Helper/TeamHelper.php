<?php

namespace App\Helper;

use App\Entity\Score;
use App\Entity\Team;

class TeamHelper
{
    public function getTeamsRankedWithScore(array $teams)
    {
        $scoreTeams = [];

        foreach ($teams as $team) {
            $teamId = $team->getId();
            $scoreTeams[$teamId] = [
                'id' => $teamId,
                'name' => $team->getName(),
                Score::SCORE_ATTRIBUTES[0] => 0,
                Score::SCORE_ATTRIBUTES[1] => 0,
                Score::SCORE_ATTRIBUTES[2] => 0,
                Score::SCORE_ATTRIBUTES[3] => 0,
            ];

            if(count($team->getScores()) > 0) {
                foreach ($team->getScores() as $score) {
                    $scoreTeams[$teamId][Score::SCORE_ATTRIBUTES[0]] += $score->getNumberKills();
                    $scoreTeams[$teamId][Score::SCORE_ATTRIBUTES[1]] += $score->getNumberDeaths();
                    $scoreTeams[$teamId][Score::SCORE_ATTRIBUTES[2]] += $score->getNumberAssists();
                    $scoreTeams[$teamId][Score::SCORE_ATTRIBUTES[3]] += $score->getTotalPoints();
                }
            }
        }

        return $this->sortTeamsByTotalPoints($scoreTeams);
    }

    public function sortTeamsByTotalPoints($teams)
    {
        $key_values = array_column($teams, Score::SCORE_ATTRIBUTES[3]);
        array_multisort($key_values, SORT_DESC, $teams);

        return $teams;
    }

}
