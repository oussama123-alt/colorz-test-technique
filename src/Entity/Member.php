<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member
{
    const POWERS = [
        'Radiation resistance'      => 'RR',
        'Turning tiny'              => 'TT',
        'Radiation blast'           => 'TB',
        'Million tonne punch'       => 'MTP',
        'Damage resistance'         => 'DR',
        'Superhuman reflexes'       => 'SR',
        'Immortality'               => 'IM',
        'Heat Immunity'             => 'HI',
        'Inferno'                   => 'IF',
        'Teleportation'             => 'TEL',
        'Interdimensional travel'   => 'IT',
        'Cheese Control'            => 'CC',
        'Drink really fast'         => 'DRF',
        'Hyper slowing writer'      => 'HSW',
        'Always late'               => 'AL',
        'Jump 2 feets up'           => 'J2F',
        'Never stop jumping'        => 'NSJ',
        'Cry a lot'                 => 'CAL',
        'Sing to charm'             => 'STC',
        'Infernal groove'           => 'IG',
        'Burn all dancfloors'       => 'BAD',
        'Mortality'                 => 'M',
        'Invisibility'              => 'INV',
    ];

    const COLUMNS = [
        'Squad name',
        'Home Town',
        'Name',
        'Secret ID',
        'Age',
        'Number of Power',
        'Power0',
        'PowerCode0',
        'Power1',
        'PowerCode1',
        'Power2',
        'PowerCode2',
        'Power3',
        'PowerCode3',
        'Power4',
        'PowerCode4'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secretIdentity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSecretIdentity(): ?string
    {
        return $this->secretIdentity;
    }

    public function setSecretIdentity(?string $secretIdentity): self
    {
        $this->secretIdentity = $secretIdentity;

        return $this;
    }
}
