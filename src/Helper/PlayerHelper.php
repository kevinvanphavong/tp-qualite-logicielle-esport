<?php

namespace App\Helper;

use App\Entity\Score;
use Doctrine\ORM\PersistentCollection;

class PlayerHelper
{
    public function getPlayersRankedWithScore(PersistentCollection $players)
    {
        $scorePlayers = [];

        foreach ($players as $player) {
            $playerId = $player->getId();
            $scorePlayers[$playerId] = [
                'id' => $playerId,
                'name' => $player->getName(),
                Score::SCORE_ATTRIBUTES[0] => 0,
                Score::SCORE_ATTRIBUTES[1] => 0,
                Score::SCORE_ATTRIBUTES[2] => 0,
                Score::SCORE_ATTRIBUTES[3] => 0,
            ];

            if(count($player->getScores()) > 0) {
                foreach ($player->getScores() as $score) {
                    $scorePlayers[$playerId][Score::SCORE_ATTRIBUTES[0]] += $score->getNumberKills();
                    $scorePlayers[$playerId][Score::SCORE_ATTRIBUTES[1]] += $score->getNumberDeaths();
                    $scorePlayers[$playerId][Score::SCORE_ATTRIBUTES[2]] += $score->getNumberAssists();
                    $scorePlayers[$playerId][Score::SCORE_ATTRIBUTES[3]] += $score->getTotalPoints();
                }
            }
        }

        return $this->sortPlayersByTotalPoints($scorePlayers);
    }

    public function sortPlayersByTotalPoints($players)
    {
        $key_values = array_column($players, Score::SCORE_ATTRIBUTES[3]);
        array_multisort($key_values, SORT_DESC, $players);

        return $players;
    }
}
