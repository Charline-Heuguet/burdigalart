<?php

namespace App\Entity;

use App\Entity\Scene;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtistRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource(
    operations: [
        new Get(), // Tout le monde peut voir la fiche.
        new GetCollection(),// Tout le monde peut voir la fiche.
        new Post(
            security: 'is_granted("ROLE_ARTIST")',
            securityMessage: 'Seuls les artistes peuvent créer leur fiche.'
        ),
        new Put(
            security: 'object.getUser() == user', // L'artiste peut modifier sa fiche.
        ),
        new Delete(
            security: 'object.getUser() == user', // L'artiste peut supprimer sa fiche.
        ),
    ]
)]
#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $artistName = null;

    #[ORM\Column(length: 255)]
    private ?string $officialPhoto = null;

    #[ORM\Column(length: 255)]
    private ?string $linkExcerpt = null;

    #[ORM\Column(length: 255)]
    private ?string $instagram = null;

    #[ORM\Column(length: 255)]
    private ?string $facebook = null;

    #[ORM\Column(length: 255)]
    private ?string $showPhoto = null;

    #[ORM\Column(length: 255)]
    private ?string $showTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $showDescription = null;

    #[ORM\ManyToOne(inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Style $style = null;

    #[ORM\ManyToOne(inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'artistRecommended')]
    private Collection $recommendedBy;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'recommendedBy')]
    private Collection $artistRecommended;

    #[ORM\ManyToMany(targetEntity: Scene::class, inversedBy: 'artists')]
    private Collection $scene;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->recommendedBy = new ArrayCollection();
        $this->artistRecommended = new ArrayCollection();
        $this->scene = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtistName(): ?string
    {
        return $this->artistName;
    }

    public function setArtistName(string $artistName): static
    {
        $this->artistName = $artistName;

        return $this;
    }

    public function getOfficialPhoto(): ?string
    {
        return $this->officialPhoto;
    }

    public function setOfficialPhoto(string $officialPhoto): static
    {
        $this->officialPhoto = $officialPhoto;

        return $this;
    }

    public function getLinkExcerpt(): ?string
    {
        return $this->linkExcerpt;
    }

    public function setLinkExcerpt(string $linkExcerpt): static
    {
        $this->linkExcerpt = $linkExcerpt;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(string $instagram): static
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(string $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getShowPhoto(): ?string
    {
        return $this->showPhoto;
    }

    public function setShowPhoto(string $showPhoto): static
    {
        $this->showPhoto = $showPhoto;

        return $this;
    }

    public function getShowTitle(): ?string
    {
        return $this->showTitle;
    }

    public function setShowTitle(string $showTitle): static
    {
        $this->showTitle = $showTitle;

        return $this;
    }

    public function getShowDescription(): ?string
    {
        return $this->showDescription;
    }

    public function setShowDescription(string $showDescription): static
    {
        $this->showDescription = $showDescription;

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

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): static
    {
        $this->style = $style;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRecommendedBy(): Collection
    {
        return $this->recommendedBy;
    }

    public function addRecommendedBy(self $recommendedBy): static
    {
        if (!$this->recommendedBy->contains($recommendedBy)) {
            $this->recommendedBy->add($recommendedBy);
        }

        return $this;
    }

    public function removeRecommendedBy(self $recommendedBy): static
    {
        $this->recommendedBy->removeElement($recommendedBy);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getArtistRecommended(): Collection
    {
        return $this->artistRecommended;
    }

    public function addArtistRecommended(self $artistRecommended): static
    {
        if (!$this->artistRecommended->contains($artistRecommended)) {
            $this->artistRecommended->add($artistRecommended);
            $artistRecommended->addRecommendedBy($this);
        }

        return $this;
    }

    public function removeArtistRecommended(self $artistRecommended): static
    {
        if ($this->artistRecommended->removeElement($artistRecommended)) {
            $artistRecommended->removeRecommendedBy($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Scene>
     */
    public function getScene(): Collection
    {
        return $this->scene;
    }

    public function addScene(Scene $scene): static
    {
        if (!$this->scene->contains($scene)) {
            $this->scene->add($scene);
        }

        return $this;
    }

    public function removeScene(Scene $scene): static
    {
        $this->scene->removeElement($scene);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
