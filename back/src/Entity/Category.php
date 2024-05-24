<?php

namespace App\Entity;

use App\Entity\Style;
use App\Entity\Artist;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category:index','artist:index','artist:show','artist:update','style:index'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['category:index','artist:index','artist:show','artist:update','style:index'])]
    private ?string $categoryName = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Style::class)]
    private Collection $styles;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Artist::class)]
    private Collection $artists;

    public function __construct()
    {
        $this->styles = new ArrayCollection();
        $this->artists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): static
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    public function addStyle(Style $style): static
    {
        if (!$this->styles->contains($style)) {
            $this->styles->add($style);
            $style->setCategory($this);
        }

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        if ($this->styles->removeElement($style)) {
            // set the owning side to null (unless already changed)
            if ($style->getCategory() === $this) {
                $style->setCategory(null);
            }
        }

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
            $artist->setCategory($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getCategory() === $this) {
                $artist->setCategory(null);
            }
        }

        return $this;
    }
}
