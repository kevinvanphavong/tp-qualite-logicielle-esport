<?php

namespace App\Helper;

use App\Entity\Game;

class GameDataHelper
{
    public function getCurrentGame($team = null, $player = null, $score = null): Game
    {
        if($team) {
            return $game = $team->getGame();
        } elseif($player) {
            return $game = $player->getGame();
        } elseif($score) {
            return $game = $score->getGame();
        } else {
            return ['id' => 404];
        }
    }
}
