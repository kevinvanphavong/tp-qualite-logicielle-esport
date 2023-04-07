<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'allGames' => $gameRepository->findAll(),
        ]);
    }
}
