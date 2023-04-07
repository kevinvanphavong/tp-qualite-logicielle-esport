<?php

namespace App\Controller;

use App\Entity\Ematch;
use App\Entity\Game;
use App\Form\ScoreType;
use App\Repository\EmatchRepository;
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

    #[Route('/game/{game_id}/ematch/{ematch_id}', name: 'ematch_edit', methods: ['get'])]
    #[ParamConverter('game', class: 'App\Entity\Game', options: ['id' => 'game_id'])]
    #[ParamConverter('ematch', class: 'App\Entity\Ematch', options: ['id' => 'ematch_id'])]
    public function editEmatchScore(Game $game, Ematch $ematch, EmatchRepository $ematchRepository, Request $request): Response
    {
        $scoreForm = $this->createForm(ScoreType::class);
        $scoreForm->handleRequest($request);

        if ($scoreForm->isSubmitted() && $scoreForm->isValid()) {

            dump($scoreForm->getData());
            die();

//            return $this->redirectToRoute('ematches', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('ematch/edit-score.html.twig', [
            'game' => $game,
            'ematch' => $ematch,
            'teams' => $ematch->getTeams(),
            'scoreForm' => $scoreForm->createView(),
            'ematches' => $ematchRepository->findBy(['game' => $game->getId()]),
        ]);
    }
}
