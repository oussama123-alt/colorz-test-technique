<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    const COLUMNS = [
        'Squad Name',
        'HomeTown',
        'Formed Year',
        'Base',
        'Number of members',
        'Average Age',
        'Is Active'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $squadName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $homeTown = null;

    #[ORM\Column(nullable: true)]
    private ?int $formed = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secretBase = null;

    #[ORM\Column(nullable: true)]
    private ?bool $active = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSquadName(): ?string
    {
        return $this->squadName;
    }

    public function setSquadName(?string $squadName): self
    {
        $this->squadName = $squadName;

        return $this;
    }

    public function getHomeTown(): ?string
    {
        return $this->homeTown;
    }

    public function setHomeTown(?string $homeTown): self
    {
        $this->homeTown = $homeTown;

        return $this;
    }

    public function getFormed(): ?int
    {
        return $this->formed;
    }

    public function setFormed(?int $formed): self
    {
        $this->formed = $formed;

        return $this;
    }

    public function getSecretBase(): ?string
    {
        return $this->secretBase;
    }

    public function setSecretBase(?string $secretBase): self
    {
        $this->secretBase = $secretBase;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
