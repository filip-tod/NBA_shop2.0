<?php

namespace App\Entity;

use App\Repository\NbaTeamRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NbaTeamRepository::class)]
class NbaTeam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $trener = null;

    #[ORM\Column(length: 255)]
    private ?string $divizija = null;

    #[ORM\OneToOne(mappedBy: 'nba_team', cascade: ['persist', 'remove'])]
    private ?Igrac $igrac = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrener(): ?string
    {
        return $this->trener;
    }

    public function setTrener(string $trener): self
    {
        $this->trener = $trener;

        return $this;
    }

    public function getDivizija(): ?string
    {
        return $this->divizija;
    }

    public function setDivizija(string $divizija): self
    {
        $this->divizija = $divizija;

        return $this;
    }

    public function getIgrac(): ?Igrac
    {
        return $this->igrac;
    }

    public function setIgrac(Igrac $igrac): self
    {
        // set the owning side of the relation if necessary
        if ($igrac->getNbaTeam() !== $this) {
            $igrac->setNbaTeam($this);
        }

        $this->igrac = $igrac;

        return $this;
    }
}
