<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Team;
use App\Helper\GameDataHelper;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    #[Route('/game/{game_id}/teams', name: 'teams')]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    public function index(Game $game, GameDataHelper $gameDataHelper): Response
    {
        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
            'game' => $game,
            'teams' => $game->getTeams(),
        ]);
    }

    #[Route('/game/{game_id}/team/{team_id}', name: 'add_players_to_team', methods: ['post'])]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    #[ParamConverter('team', class: 'App\Entity\Team', options: ['id' => 'team_id'])]
    public function addPlayersToTeam(Game $game, Team $team, EntityManagerInterface $entityManager, Request $request): Response
    {
        try {
            // Get the data from the $request
            $inputsData = json_decode($request->getContent());
            for ($i = 0; $i < count($inputsData); $i++) {
                $player = new Player();
                $player->setName($inputsData[$i]);
                $player->setTeam($team);
                $player->setGame($game);
                $entityManager->persist($player);
            }
            $entityManager->flush();

            return new Response(
                'Player(s) added succesfully',
                200
            );
        } catch (\Exception $e) {
            return new Response(
                'Error: ' . $e->getMessage(),
                500
            );
        }
    }
}
