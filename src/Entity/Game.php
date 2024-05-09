<?php

namespace App\Entity;

use App\Enum\Division;
use App\Enum\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(name: "division", type: "string", nullable: true, enumType: Division::class)]
    private ?Division $division;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(name: "team_home_id", referencedColumnName: "id", nullable: false)]
    private Team $teamHome;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(name: "team_away_id", referencedColumnName: "id", nullable: false)]
    private Team $teamAway;

    #[ORM\Column]
    private int $score_home;

    #[ORM\Column]
    private int $score_away;

    #[ORM\Column(name: "type", type: "string", enumType: GameType::class)]
    private GameType $type;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDivision(): ?Division
    {
        return $this->division;
    }

    public function setDivision(Division $division): static
    {
        $this->division = $division;

        return $this;
    }


    public function getTeamHome(): Team
    {
        return $this->teamHome;
    }

    public function setTeamHome(Team $teamHome): static
    {
        $this->teamHome = $teamHome;

        return $this;
    }

    public function getTeamAway(): Team
    {
        return $this->teamAway;
    }

    public function setTeamAway(Team $teamAway): static
    {
        $this->teamAway = $teamAway;

        return $this;
    }

    public function getScoreHome(): ?int
    {
        return $this->score_home;
    }

    public function setScoreHome(int $score_home): static
    {
        $this->score_home = $score_home;

        return $this;
    }

    public function getScoreAway(): int
    {
        return $this->score_away;
    }

    public function setScoreAway(int $score_away): static
    {
        $this->score_away = $score_away;

        return $this;
    }

    public function getType(): GameType
    {
        return $this->type;
    }

    public function setType(GameType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
