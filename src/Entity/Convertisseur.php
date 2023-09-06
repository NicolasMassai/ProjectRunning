<?php

namespace App\Entity;

use App\Repository\ConvertisseurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\Double;
use PhpParser\Node\Stmt\Do_;

#[ORM\Entity(repositoryClass: ConvertisseurRepository::class)]
class Convertisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?float $vitesse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allure = null;
/*
    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $allure = null;*/

    #[ORM\Column(nullable: true)]
    private ?int $distance = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $temps = null;
  
   /* #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;
*/
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVitesse(): ?float
    {
        return $this->vitesse;
    }

    public function setVitesse(?float $vitesse): static
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getAllure(): ?string
    {
        return $this->allure;
    }

    public function setAllure(?string $allure): static
    {
        $this->allure = $allure;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): static
    {
        $this->distance = $distance;

        return $this;
    }

    public function getTemps(): ?\DateTimeInterface
    {
        return $this->temps;
    }

    public function setTemps(?\DateTimeInterface $temps): static
    {
        $this->temps = $temps;

        return $this;
    }

   /* public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }*/
/*
    public function __toString(){
        return $this->name; // Remplacer champ par une propriété "string" de l'entité
    }*/

  
}
