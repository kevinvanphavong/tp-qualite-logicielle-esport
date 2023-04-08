<?php

namespace App\Controller;

use App\Entity\Ematch;
use App\Entity\Game;
use App\Entity\Score;
use App\Form\ScoreType;
use App\Helper\ScoreDataHelper;
use App\Repository\EmatchRepository;
use App\Repository\PlayerRepository;
use App\Repository\ScoreRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EmatchController extends AbstractController
{
    #[Route('/game/{game_id}/ematches', name: 'ematches', methods: ['get'])]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    public function index(Game $game, EmatchRepository $ematchRepository): Response
    {
        return $this->render('ematch/index.html.twig', [
            'game' => $game,
            'ematches' => $ematchRepository->findBy(['game' => $game->getId()]),
        ]);
    }

    #[Route('/game/{game_id}/ematch/{ematch_id}', name: 'ematch_show', methods: ['get', 'post'])]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    #[ParamConverter('ematch', class: 'App\Entity\Ematch', options: ['id' => 'ematch_id'])]
    public function showEmatchScore(Game $game, Ematch $ematch, EmatchRepository $ematchRepository, Request $request): Response
    {
        return $this->render('ematch/edit-score.html.twig', [
            'game' => $game,
            'ematch' => $ematch,
            'teams' => $ematch->getTeams(),
            'ematches' => $ematchRepository->findBy(['game' => $game->getId()]),
        ]);
    }

    #[Route('/edit-ematch-score/{game_id}/{ematch_id}', name: 'ematch_edit', methods: ['post'])]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    #[ParamConverter('ematch', class: 'App\Entity\Ematch', options: ['id' => 'ematch_id'])]
    public function createEmatchScore(
        Game $game,
        Ematch $ematch,
        PlayerRepository $playerRepository,
        ScoreRepository $scoreRepository,
        EntityManagerInterface $em,
        ScoreDataHelper $scoreDataHelper,
        Request $request
    ) {
        try {
            foreach (json_decode($request->getContent()) as $playerId => $scoreLine) {
                // Load the player
                $player = $playerRepository->find($playerId);

                // Load the score
                $score = $scoreRepository->findOneBy(['player' => $playerId, 'ematch' => $ematch->getId()]);
                if($score == null) {
                    $score = new Score();
                    $player->addScore($score);
                }

                // Set score for the player
                $score->setPlayer($player);
                $score->setEmatch($ematch);

                $score->setNumberKills($scoreLine->kills);
                $score->setNumberDeaths($scoreLine->deaths);
                $score->setNumberAssists($scoreLine->assists);
                $score->setTotalPoints($score->getNumberKills() + $score->getNumberAssists() - $score->getNumberDeaths());

                $em->persist($score);
            }

            $scoreDataHelper->updateTeamScore($game, $ematch);
            $em->flush();

            return new Response('Score saved', 200);
        } catch (\Exception $e) {
            return new Response($e->getMessage(), 500);
        }
    }
}
