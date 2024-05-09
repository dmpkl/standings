<?php

namespace App\Entity;

use App\Enum\Division;
use App\Enum\GamePoints;
use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(name: "division", type: "string", enumType: Division::class)]
    private Division $division;

    #[ORM\Column]
    private int $points = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDivision(): Division
    {
        return $this->division;
    }

    public function setDivision(Division $division): static
    {
        $this->division = $division;

        return $this;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function addPoints(GamePoints $points): static
    {
        $this->points += $points->value;

        return $this;
    }
}
