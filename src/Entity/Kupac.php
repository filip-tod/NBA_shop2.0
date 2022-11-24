<?php

namespace App\Entity;

use App\Repository\KupacRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KupacRepository::class)]
class Kupac
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ime = null;

    #[ORM\Column(length: 255)]
    private ?string $prezime = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $adresa = null;

    #[ORM\ManyToMany(targetEntity: Dostava::class, mappedBy: 'kupac')]
    private Collection $dostavas;

    public function __construct()
    {
        $this->dostavas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIme(): ?string
    {
        return $this->ime;
    }

    public function setIme(string $ime): self
    {
        $this->ime = $ime;

        return $this;
    }

    public function getPrezime(): ?string
    {
        return $this->prezime;
    }

    public function setPrezime(string $prezime): self
    {
        $this->prezime = $prezime;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresa(): ?string
    {
        return $this->adresa;
    }

    public function setAdresa(string $adresa): self
    {
        $this->adresa = $adresa;

        return $this;
    }

    /**
     * @return Collection<int, Dostava>
     */
    public function getDostavas(): Collection
    {
        return $this->dostavas;
    }

    public function addDostava(Dostava $dostava): self
    {
        if (!$this->dostavas->contains($dostava)) {
            $this->dostavas->add($dostava);
            $dostava->addKupac($this);
        }

        return $this;
    }

    public function removeDostava(Dostava $dostava): self
    {
        if ($this->dostavas->removeElement($dostava)) {
            $dostava->removeKupac($this);
        }

        return $this;
    }
}
