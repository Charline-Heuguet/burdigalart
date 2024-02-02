<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtistRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource]
#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $OfficialPhoto = null;

    #[ORM\Column(length: 255)]
    private ?string $ArtistName = null;

    #[ORM\Column(length: 255)]
    private ?string $LinkExcerpt = null;

    #[ORM\Column(length: 255)]
    private ?string $Facebook = null;

    #[ORM\Column(length: 255)]
    private ?string $Instagram = null;

    #[ORM\Column(length: 255)]
    private ?string $ShowPhoto = null;

    #[ORM\Column(length: 255)]
    private ?string $ShowTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ShowDescription = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(targetEntity:User::class,inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity:Style::class, inversedBy: 'artists')]
    private ?Style $style = null;

    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'artists')]
    private Collection $events;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'recommandedBy')]
    private Collection $artistRecommended;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'artistRecommended')]
    private Collection $recommandedBy;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->artistRecommended = new ArrayCollection();
        $this->recommandedBy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfficialPhoto(): ?string
    {
        return $this->OfficialPhoto;
    }

    public function setOfficialPhoto(string $OfficialPhoto): static
    {
        $this->OfficialPhoto = $OfficialPhoto;

        return $this;
    }

    public function getArtistName(): ?string
    {
        return $this->ArtistName;
    }

    public function setArtistName(string $ArtistName): static
    {
        $this->ArtistName = $ArtistName;

        return $this;
    }

    public function getLinkExcerpt(): ?string
    {
        return $this->LinkExcerpt;
    }

    public function setLinkExcerpt(string $LinkExcerpt): static
    {
        $this->LinkExcerpt = $LinkExcerpt;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->Facebook;
    }

    public function setFacebook(string $Facebook): static
    {
        $this->Facebook = $Facebook;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->Instagram;
    }

    public function setInstagram(string $Instagram): static
    {
        $this->Instagram = $Instagram;

        return $this;
    }

    public function getShowPhoto(): ?string
    {
        return $this->ShowPhoto;
    }

    public function setShowPhoto(string $ShowPhoto): static
    {
        $this->ShowPhoto = $ShowPhoto;

        return $this;
    }

    public function getShowTitle(): ?string
    {
        return $this->ShowTitle;
    }

    public function setShowTitle(string $ShowTitle): static
    {
        $this->ShowTitle = $ShowTitle;

        return $this;
    }

    public function getShowDescription(): ?string
    {
        return $this->ShowDescription;
    }

    public function setShowDescription(string $ShowDescription): static
    {
        $this->ShowDescription = $ShowDescription;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        $this->events->removeElement($event);

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
        }

        return $this;
    }

    public function removeArtistRecommended(self $artistRecommended): static
    {
        $this->artistRecommended->removeElement($artistRecommended);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRecommandedBy(): Collection
    {
        return $this->recommandedBy;
    }

    public function addRecommandedBy(self $recommandedBy): static
    {
        if (!$this->recommandedBy->contains($recommandedBy)) {
            $this->recommandedBy->add($recommandedBy);
            $recommandedBy->addArtistRecommended($this);
        }

        return $this;
    }

    public function removeRecommandedBy(self $recommandedBy): static
    {
        if ($this->recommandedBy->removeElement($recommandedBy)) {
            $recommandedBy->removeArtistRecommended($this);
        }

        return $this;
    }
}
