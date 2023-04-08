<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score
{
    const SCORE_ATTRIBUTES = [
        'kills',
        'deaths',
        'assists',
        'totalPoints',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ematch $ematch = null;

    #[ORM\Column]
    private ?int $totalPoints = null;

    #[ORM\Column]
    private ?int $numberKills = null;

    #[ORM\Column]
    private ?int $numberDeaths = null;

    #[ORM\Column]
    private ?int $numberAssists = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    private ?Team $team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getEmatch(): ?Ematch
    {
        return $this->ematch;
    }

    public function setEmatch(?Ematch $ematch): self
    {
        $this->ematch = $ematch;

        return $this;
    }

    public function getTotalPoints(): ?int
    {
        return $this->totalPoints;
    }

    public function setTotalPoints(int $totalPoints): self
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    public function getNumberKills(): ?int
    {
        return $this->numberKills;
    }

    public function setNumberKills(int $numberKills): self
    {
        $this->numberKills = $numberKills;

        return $this;
    }

    public function getNumberDeaths(): ?int
    {
        return $this->numberDeaths;
    }

    public function setNumberDeaths(int $numberDeaths): self
    {
        $this->numberDeaths = $numberDeaths;

        return $this;
    }

    public function getNumberAssists(): ?int
    {
        return $this->numberAssists;
    }

    public function setNumberAssists(int $numberAssists): self
    {
        $this->numberAssists = $numberAssists;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
