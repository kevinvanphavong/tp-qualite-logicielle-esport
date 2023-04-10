<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Team;
use App\Helper\GameDataHelper;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
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

    #[Route('/game/{game_id}/team/{team_id}/add-players', name: 'add_players_to_team', methods: ['post'])]
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
            $this->addFlash('success', 'Changes made succesfully');
            return new Response(
                'Player(s) added succesfully',
                200
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Changes not validated - contact admin');
            return new Response(
                'Error: ' . $e->getMessage(),
                500
            );
        }
    }

    #[Route('/game/{game_id}/team/{team_id}/delete-player', name: 'delete_player_from_team', methods: ['post'])]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    #[ParamConverter('team', class: 'App\Entity\Team', options: ['id' => 'team_id'])]
    public function deletePlayerFromTeam(Game $game, Team $team, PlayerRepository $playerRepository, Request $request): Response
    {
        try {
            $playerRepository->remove(intval(json_decode($request->getContent())), true);

            $this->addFlash('success', 'Changes made succesfully');
            return new Response(
                'Player deleted succesfully',
                200
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Changes not validated - contact admin');
            return new Response(
                'Error: ' . $e->getMessage(),
                500
            );
        }
    }

    #[Route('/game/{game_id}/add-teams', name: 'add_teams_to_game', methods: ['post'])]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    public function addTeamsToGame(Game $game, EntityManagerInterface $entityManager, Request $request): Response
    {
        try {
            $inputsData = json_decode($request->getContent());
            for ($i = 0; $i < count($inputsData); $i++) {
                $team = new Team();
                $team->setName($inputsData[$i]);
                $team->setGame($game);
                $entityManager->persist($team);
            }
            $entityManager->flush();
            $this->addFlash('success', 'Team(s) added succesfully');
            return new Response(
                'Team(s) added succesfully',
                200
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Changes not validated - contact admin');
            return new Response(
                'Error: ' . $e->getMessage(),
                500
            );
        }
    }

    #[Route('/game/{game_id}/delete-team', name: 'delete_team_from_game', methods: ['post'])]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    public function deleteTeamFromGame(Game $game, TeamRepository $teamRepository, Request $request): Response
    {
        try {
            $teamRepository->remove(intval(json_decode($request->getContent())), true);

            $this->addFlash('success', 'Team deleted succesfully');
            return new Response(
                'Team deleted succesfully',
                200
            );
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Changes not validated - contact admin');
            return new Response(
                'Error: ' . $e->getMessage(),
                500
            );
        }
    }
}
