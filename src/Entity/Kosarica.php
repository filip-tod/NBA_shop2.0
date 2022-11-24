<?php

namespace App\Entity;

use App\Repository\KosaricaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KosaricaRepository::class)]
class Kosarica
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $tezina = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum_isporuke = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $cijena = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Oprema $oprema = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTezina(): ?string
    {
        return $this->tezina;
    }

    public function setTezina(string $tezina): self
    {
        $this->tezina = $tezina;

        return $this;
    }

    public function getDatumIsporuke(): ?\DateTimeInterface
    {
        return $this->datum_isporuke;
    }

    public function setDatumIsporuke(\DateTimeInterface $datum_isporuke): self
    {
        $this->datum_isporuke = $datum_isporuke;

        return $this;
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

    public function getOprema(): ?Oprema
    {
        return $this->oprema;
    }

    public function setOprema(?Oprema $oprema): self
    {
        $this->oprema = $oprema;

        return $this;
    }
}
