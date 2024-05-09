<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\Team;
use App\Enum\Division;
use App\Enum\GamePoints;
use App\Enum\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;

class GameService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function removeAllGames(): void
    {
        $games = $this->entityManager->getRepository(Game::class)->findAll();

        foreach ($games as $game) {
            $this->entityManager->remove($game);
        }

        $this->entityManager->flush();
    }


    public function simulateGame(
        Team $teamHome,
        Team $teamAway,
        Division $division,
        GameType $type
    ): void
    {
        $faker = Factory::create();

        $scoreHome = $faker->numberBetween(0, 5);
        $scoreAway = $faker->numberBetween(0, 5);

        $game = new Game();
        $game->setDivision($division)
            ->setTeamHome($teamHome)
            ->setTeamAway($teamAway)
            ->setScoreHome($scoreHome)
            ->setScoreAway($scoreAway)
            ->setType($type);

        if ($scoreHome > $scoreAway) {
            $teamHome->addPoints(GamePoints::Win);
        } elseif ($scoreHome < $scoreAway) {
            $teamAway->addPoints(GamePoints::Win);
        } else {
            $teamHome->addPoints(GamePoints::Draw);
            $teamAway->addPoints(GamePoints::Draw);
        }

        $this->entityManager->persist($game);
        $this->entityManager->persist($teamHome);
        $this->entityManager->persist($teamAway);
        $this->entityManager->flush();
    }

    public function getGames(): array
    {
        return $this->entityManager->getRepository(Game::class)->findAll();
    }
}
