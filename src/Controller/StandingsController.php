<?php

namespace App\Controller;

use App\Form\SimulateRegularChampionshipType;
use App\Form\StartChampionshipType;
use App\Service\ChampionshipService;
use App\Service\GameService;
use App\Service\TeamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StandingsController extends AbstractController
{
    #[Route('/standings', name: 'app_standings')]
    public function index(TeamService $teamService, GameService $gameService, Request $request): Response
    {
        $startChampionshipButton = $this->createForm(StartChampionshipType::class);
        $startChampionshipButton->handleRequest($request);

        $simulateChampionshipTourButton = $this->createForm(SimulateRegularChampionshipType::class);
        $simulateChampionshipTourButton->handleRequest($request);

        $teams = $teamService->getTeams();
        $games = $gameService->getGames();

        return $this->render('standings/index.html.twig', [
            'startChampionshipButton' => $startChampionshipButton->createView(),
            'simulateChampionshipTourButton' => $simulateChampionshipTourButton->createView(),
            'teams' => $teams,
            'games' => $games,
        ]);
    }

    #[Route('/standings/refresh', name: 'app_refresh_standings')]
    public function refresh(GameService $gameService, TeamService $teamService): Response
    {
        $gameService->removeAllGames();
        $teamService->removeAllTeams();
        $teamService->generateTeams();

        return $this->redirectToRoute('app_standings');
    }

    #[Route('/championship/simulate-regular', name: 'app_simulate_regular_championship')]
    public function simulateRegularChampionship(ChampionshipService $championshipService): Response
    {
        $championshipService->simulateRegular();

        return $this->redirectToRoute('app_standings');
    }
}
