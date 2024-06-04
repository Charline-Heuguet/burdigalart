<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['artist:index', 'artist:show', 'artist:update', 'event:index', 'event:show', 'event:update'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['artist:index', 'artist:show', 'artist:update', 'event:index', 'event:show', 'event:update', 'user:index', 'user:show', 'user:create', 'user:update',])]
    private ?string $artistName = null;

    #[Groups(['artist:index', 'artist:show', 'artist:update', 'event:index', 'event:show', 'event:update',])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Groups(['artist:index', 'artist:show', 'artist:update', 'event:index', 'event:show', 'event:update'])]
    #[ORM\Column(length: 255)]
    private ?string $officialPhoto = null;

    #[Groups(['artist:show', 'artist:update'])]
    #[ORM\Column(length: 255)]
    private ?string $linkExcerpt = null;

    #[Groups(['artist:show', 'artist:update'])]
    #[ORM\Column(length: 255)]
    private ?string $instagram = null;

    #[Groups(['artist:show', 'artist:update'])]
    #[ORM\Column(length: 255)]
    private ?string $facebook = null;

    #[Groups(['artist:show', 'artist:update', 'scene_artist:show', 'event:index', 'event:show', 'event:update'])]
    #[ORM\Column(length: 255)]
    private ?string $showPhoto = null;

    #[Groups(['artist:show', 'artist:update', 'scene_artist:show', 'event:show', 'event:index', 'event:show', 'event:update'])]
    #[ORM\Column(length: 255)]
    private ?string $showTitle = null;

    #[Groups(['artist:show', 'artist:update', 'scene_artist:show', 'event:show', 'event:index', 'event:show', 'event:update'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $showDescription = null;

    #[Groups(['artist:index', 'artist:show', 'artist:update', 'event:show', 'user:index', 'user:show', 'user:create', 'user:update',])]
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[Groups(['artist:index', 'artist:show', 'artist:update', 'user:index', 'user:show', 'user:create', 'user:update'])]
    #[ORM\Column(type: 'boolean')]
    private ?bool $subscription = false;

    #[Groups(['artist:index', 'artist:show', 'artist:update', 'category:index'])]
    #[ORM\ManyToOne(inversedBy: 'artists', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[Groups(['artist:index', 'artist:show', 'artist:update', 'event:show'])]
    #[ORM\ManyToOne(inversedBy: 'artists', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Style $style = null;

    #[Groups(['artist:index', 'artist:show', 'artist:update'])]
    #[ORM\ManyToOne(inversedBy: 'artists', cascade: ['persist'])]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private ?User $user = null;

    #[Groups(['artist:index', 'artist:show', 'artist:update'])]
    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'Artist')]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: Message::class)]
    private Collection $messages;

    // LES RECOMMANDATIONS - a voir plus tard...
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'artistRecommended')]
    private Collection $recommendedBy;

    // LES RECOMMANDATIONS - a voir plus tard...
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'recommendedBy')]
    private Collection $artistRecommended;

    public function __construct()
    {
        $this->recommendedBy = new ArrayCollection();
        $this->artistRecommended = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->messages = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateSlug(): void
    {
        error_log("updateSlug called for: " . $this->artistName);
        if ($this->artistName) {
            $this->slug = $this->createSlug($this->artistName);
        }
    }

    private function createSlug(string $name): string
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
        $slug = strtolower(trim($slug, '-'));
        return $slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isSubscription(): ?bool
    {
        return $this->subscription;
    }

    public function setSubscription(bool $subscription): static
    {
        $this->subscription = $subscription;

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
            $event->addArtist($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            $event->removeArtist($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setArtist($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getArtist() === $this) {
                $message->setArtist(null);
            }
        }

        return $this;
    }
}
