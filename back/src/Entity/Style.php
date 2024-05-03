<?php

namespace App\Entity;

use App\Entity\Artist;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StyleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: StyleRepository::class)]
class Style
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['artist:index','artist:show','artist:update','style:index', 'event:show'])]
    private ?int $id = null;

    #[Groups(['artist:index','artist:show','artist:update','style:index', 'event:show'])]
    #[ORM\Column(length: 255)]
    private ?string $styleName = null;

    #[ORM\ManyToOne(inversedBy: 'styles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'style', targetEntity: Artist::class)]
    private Collection $artists;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStyleName(): ?string
    {
        return $this->styleName;
    }

    public function setStyleName(string $styleName): static
    {
        $this->styleName = $styleName;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->setStyle($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getStyle() === $this) {
                $artist->setStyle(null);
            }
        }

        return $this;
    }
}
