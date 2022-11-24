<?php

namespace App\Entity;

use App\Repository\OpremaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpremaRepository::class)]
class Oprema
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cijena = null;

    #[ORM\Column(length: 255)]
    private ?string $vrsta = null;

    #[ORM\Column(length: 255)]
    private ?string $velicina = null;

    #[ORM\Column(length: 255)]
    private ?string $boja = null;

    #[ORM\ManyToOne(inversedBy: 'opremas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Igrac $igrac = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCijena(): ?string
    {
        return $this->cijena;
    }

    public function setCijena(string $cijena): self
    {
        $this->cijena = $cijena;

        return $this;
    }

    public function getVrsta(): ?string
    {
        return $this->vrsta;
    }

    public function setVrsta(string $vrsta): self
    {
        $this->vrsta = $vrsta;

        return $this;
    }

    public function getVelicina(): ?string
    {
        return $this->velicina;
    }

    public function setVelicina(string $velicina): self
    {
        $this->velicina = $velicina;

        return $this;
    }

    public function getBoja(): ?string
    {
        return $this->boja;
    }

    public function setBoja(string $boja): self
    {
        $this->boja = $boja;

        return $this;
    }

    public function getIgrac(): ?Igrac
    {
        return $this->igrac;
    }

    public function setIgrac(?Igrac $igrac): self
    {
        $this->igrac = $igrac;

        return $this;
    }
}
