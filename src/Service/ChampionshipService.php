<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Team;
use App\Enum\Division;
use App\Enum\GameType;
use Doctrine\ORM\EntityManagerInterface;

class ChampionshipService
{
    public const TEAMS_COUNT = 16;
    public const REGULAR_GAMES = ((self::TEAMS_COUNT / 2) * (self::TEAMS_COUNT / 2 - 1)) / 2
        * 2/* home + away game */ * 2/* divisions count */;

    private GameService $gameService;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, GameService $gameService)
    {
        $this->entityManager = $entityManager;
        $this->gameService = $gameService;
    }

    public function simulateRegular(): void
    {
        if ($this->entityManager->getRepository(Game::class)->count() >= self::REGULAR_GAMES) {
            return;
        }

        $teamsA = $this->entityManager->getRepository(Team::class)->findBy(['division' => Division::A]);
        $teamsB = $this->entityManager->getRepository(Team::class)->findBy(['division' => Division::B]);

        foreach ($teamsA as $indexA => $teamA) {
            foreach ($teamsA as $indexB => $teamB) {
                if ($indexA < $indexB) {
                    $this->gameService->simulateGame($teamA, $teamB, Division::A, GameType::Regular);
                    $this->gameService->simulateGame($teamB, $teamA, Division::A, GameType::Regular);
                }
            }
        }

        foreach ($teamsB as $indexA => $teamA) {
            foreach ($teamsB as $indexB => $teamB) {
                if ($indexA < $indexB) {
                    $this->gameService->simulateGame($teamA, $teamB, Division::B, GameType::Regular);
                    $this->gameService->simulateGame($teamB, $teamA, Division::B, GameType::Regular);
                }
            }
        }
    }
}
