<?php

namespace App\Service;

use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use App\Enum\Division;
use Faker\Factory;

class TeamService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addTeam(string $name, Division $division): void
    {
        $team = new Team();
        $team->setName($name);
        $team->setDivision($division);

        $this->entityManager->persist($team);
        $this->entityManager->flush();
    }

    public function removeAllTeams(): void
    {
        $teams = $this->entityManager->getRepository(Team::class)->findAll();

        foreach ($teams as $team) {
            $this->entityManager->remove($team);
        }

        $this->entityManager->flush();
    }

    public function generateTeams(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < (ChampionshipService::TEAMS_COUNT / 2); $i++) {
            $teamNameA = $faker->unique()->countryCode;
            $teamNameB = $faker->unique()->countryCode;

            $this->addTeam($teamNameA, Division::A);
            $this->addTeam($teamNameB, Division::B);
        }
    }

    public function getTeams(): array
    {
        return $this->entityManager->getRepository(Team::class)->findAll();
    }
}
