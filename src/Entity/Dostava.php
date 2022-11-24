<?php

namespace App\Entity;

use App\Repository\DostavaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DostavaRepository::class)]
class Dostava
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Kosarica::class)]
    private Collection $kosarica;

    #[ORM\ManyToMany(targetEntity: Kupac::class, inversedBy: 'dostavas')]
    private Collection $kupac;

    public function __construct()
    {
        $this->kosarica = new ArrayCollection();
        $this->kupac = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Kosarica>
     */
    public function getKosarica(): Collection
    {
        return $this->kosarica;
    }

    public function addKosarica(Kosarica $kosarica): self
    {
        if (!$this->kosarica->contains($kosarica)) {
            $this->kosarica->add($kosarica);
        }

        return $this;
    }

    public function removeKosarica(Kosarica $kosarica): self
    {
        $this->kosarica->removeElement($kosarica);

        return $this;
    }

    /**
     * @return Collection<int, Kupac>
     */
    public function getKupac(): Collection
    {
        return $this->kupac;
    }

    public function addKupac(Kupac $kupac): self
    {
        if (!$this->kupac->contains($kupac)) {
            $this->kupac->add($kupac);
        }

        return $this;
    }

    public function removeKupac(Kupac $kupac): self
    {
        $this->kupac->removeElement($kupac);

        return $this;
    }
}
