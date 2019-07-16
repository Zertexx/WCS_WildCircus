<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerformanceRepository")
 */
class Performance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", mappedBy="performance")
     */
    private $artists;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Spectacle", mappedBy="performance")
     */
    private $spectacles;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->spectacles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->addPerformance($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->contains($artist)) {
            $this->artists->removeElement($artist);
            $artist->removePerformance($this);
        }

        return $this;
    }

    /**
     * @return Collection|Spectacle[]
     */
    public function getSpectacles(): Collection
    {
        return $this->spectacles;
    }

    public function addSpectacle(Spectacle $spectacle): self
    {
        if (!$this->spectacles->contains($spectacle)) {
            $this->spectacles[] = $spectacle;
            $spectacle->addPerformance($this);
        }

        return $this;
    }

    public function removeSpectacle(Spectacle $spectacle): self
    {
        if ($this->spectacles->contains($spectacle)) {
            $this->spectacles->removeElement($spectacle);
            $spectacle->removePerformance($this);
        }

        return $this;
    }
}
