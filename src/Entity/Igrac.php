<?php

namespace App\Entity;

use App\Repository\IgracRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IgracRepository::class)]
class Igrac
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ime_i = null;

    #[ORM\Column(length: 255)]
    private ?string $prezime_i = null;

    #[ORM\Column(length: 255)]
    private ?string $visina = null;

    #[ORM\OneToOne(inversedBy: 'igrac', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?NbaTeam $nba_team = null;

    #[ORM\OneToMany(mappedBy: 'igrac', targetEntity: Oprema::class)]
    private Collection $opremas;

    public function __construct()
    {
        $this->opremas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImeI(): ?string
    {
        return $this->ime_i;
    }

    public function setImeI(string $ime_i): self
    {
        $this->ime_i = $ime_i;

        return $this;
    }

    public function getPrezimeI(): ?string
    {
        return $this->prezime_i;
    }

    public function setPrezimeI(string $prezime_i): self
    {
        $this->prezime_i = $prezime_i;

        return $this;
    }

    public function getVisina(): ?string
    {
        return $this->visina;
    }

    public function setVisina(string $visina): self
    {
        $this->visina = $visina;

        return $this;
    }

    public function getNbaTeam(): ?NbaTeam
    {
        return $this->nba_team;
    }

    public function setNbaTeam(NbaTeam $nba_team): self
    {
        $this->nba_team = $nba_team;

        return $this;
    }

    /**
     * @return Collection<int, Oprema>
     */
    public function getOpremas(): Collection
    {
        return $this->opremas;
    }

    public function addOprema(Oprema $oprema): self
    {
        if (!$this->opremas->contains($oprema)) {
            $this->opremas->add($oprema);
            $oprema->setIgrac($this);
        }

        return $this;
    }

    public function removeOprema(Oprema $oprema): self
    {
        if ($this->opremas->removeElement($oprema)) {
            // set the owning side to null (unless already changed)
            if ($oprema->getIgrac() === $this) {
                $oprema->setIgrac(null);
            }
        }

        return $this;
    }
}
