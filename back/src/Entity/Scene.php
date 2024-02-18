<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SceneRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


#[ApiResource(
    operations: [
        new GetCollection(
            //security: "is_granted('IS_AUTHENTICATED_ANONYMOUSLY')", // Tout le monde peut voir la liste des scènes.
        ),
        new Get(
            //security: "is_granted('IS_AUTHENTICATED_ANONYMOUSLY')", // Tout le monde peut voir une scène spécifique.
        ),
        new Post(
            //security: "is_granted('ROLE_MANAGER')", // Seul un gérant peut créer une scène.
            //securityMessage: "Seuls les gérants peuvent créer une scène.",
        ),
        new Put(
            //security: "object.getUser() == user", // Seul le gérant associé peut modifier une scène.
            //securityMessage: "Seul le gérant associé peut modifier cette scène.",
        ),
        new Delete(
            //security: "object.getUser() == user", // Seul le gérant associé peut supprimer une scène.
            // securityMessage: "Seul le gérant associé peut supprimer cette scène.",
        ),
    ],
)]
#[ORM\Entity(repositoryClass: SceneRepository::class)]
class Scene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $banner = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $zipcode = null;

    #[ORM\Column(length: 255)]
    private ?string $town = null;

    #[ORM\Column]
    private ?int $phoneNumber = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column(length: 255)]
    private ?string $instagram = null;

    #[ORM\Column(length: 255)]
    private ?string $facebook = null;

    #[ORM\Column(length: 255)]
    private ?string $eventTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $eventDescription = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $eventDateTime = null;

    #[ORM\Column(length: 255)]
    private ?string $eventPoster = null;

    #[ORM\Column]
    private ?float $eventPrice = null;

    #[ORM\ManyToOne(inversedBy: 'scenes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, mappedBy: 'scene')]
    private Collection $artists;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'scene')]
    private Collection $users;

    #[ORM\Column]
    private ?bool $subscription = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function setBanner(string $banner): static
    {
        $this->banner = $banner;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

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

    public function getEventTitle(): ?string
    {
        return $this->eventTitle;
    }

    public function setEventTitle(string $eventTitle): static
    {
        $this->eventTitle = $eventTitle;

        return $this;
    }

    public function getEventDescription(): ?string
    {
        return $this->eventDescription;
    }

    public function setEventDescription(string $eventDescription): static
    {
        $this->eventDescription = $eventDescription;

        return $this;
    }

    public function getEventDateTime(): ?\DateTimeImmutable
    {
        return $this->eventDateTime;
    }

    public function setEventDateTime(\DateTimeImmutable $eventDateTime): static
    {
        $this->eventDateTime = $eventDateTime;

        return $this;
    }

    public function getEventPoster(): ?string
    {
        return $this->eventPoster;
    }

    public function setEventPoster(string $eventPoster): static
    {
        $this->eventPoster = $eventPoster;

        return $this;
    }

    public function getEventPrice(): ?float
    {
        return $this->eventPrice;
    }

    public function setEventPrice(float $eventPrice): static
    {
        $this->eventPrice = $eventPrice;

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
            $artist->addScene($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            $artist->removeScene($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addScene($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeScene($this);
        }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateSlug(): void
    {
        if ($this->name) {
            $this->slug = $this->createSlug($this->name);
        }
    }

    private function createSlug(string $name): string
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
        $slug = strtolower(trim($slug, '-'));
        return $slug;
    }
}
