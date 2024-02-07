<?php

namespace App\Entity;

use App\Entity\User;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SceneRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource(
    operations: [
        new GetCollection(
            security: "is_granted('IS_AUTHENTICATED_ANONYMOUSLY')", // Tout le monde peut voir la liste des scènes.
        ),
        new Get(
            security: "is_granted('IS_AUTHENTICATED_ANONYMOUSLY')", // Tout le monde peut voir une scène spécifique.
        ),
        new Post(
            security: "is_granted('ROLE_MANAGER')", // Seul un gérant peut créer une scène.
            securityMessage: "Seuls les gérants peuvent créer une scène.",
        ),
        new Put(
            security: "object.getUser() == user", // Seul le gérant associé peut modifier une scène.
            securityMessage: "Seul le gérant associé peut modifier cette scène.",
        ),
        new Delete(
            security: "object.getUser() == user", // Seul le gérant associé peut supprimer une scène.
            securityMessage: "Seul le gérant associé peut supprimer cette scène.",
        ),
    ]
)]
#[ORM\Entity(repositoryClass: SceneRepository::class)]
class Scene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $SIRET = null;

    #[ORM\Column(length: 255)]
    private ?string $Banner = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Address = null;

    #[ORM\Column]
    private ?int $ZipCode = null;

    #[ORM\Column(length: 255)]
    private ?string $Town = null;

    #[ORM\Column]
    private ?int $Phone = null;

    #[ORM\Column]
    private ?int $Capacity = null;

    #[ORM\Column(length: 255)]
    private ?string $Instagram = null;

    #[ORM\Column(length: 255)]
    private ?string $Facebook = null;

    #[ORM\ManyToOne(targetEntity:User::class, inversedBy: 'scenes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $eventTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $eventDescription = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $eventDatetime = null;

    #[ORM\Column(length: 255)]
    private ?string $eventPoster = null;

    #[ORM\Column]
    private ?float $eventPrice = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, mappedBy: 'scene')]
    private Collection $artists;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'scene')]
    private Collection $users;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSIRET(): ?int
    {
        return $this->SIRET;
    }

    public function setSIRET(int $SIRET): static
    {
        $this->SIRET = $SIRET;

        return $this;
    }

    public function getBanner(): ?string
    {
        return $this->Banner;
    }

    public function setBanner(string $Banner): static
    {
        $this->Banner = $Banner;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): static
    {
        $this->Address = $Address;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->ZipCode;
    }

    public function setZipCode(int $ZipCode): static
    {
        $this->ZipCode = $ZipCode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->Town;
    }

    public function setTown(string $Town): static
    {
        $this->Town = $Town;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->Phone;
    }

    public function setPhone(int $Phone): static
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->Capacity;
    }

    public function setCapacity(int $Capacity): static
    {
        $this->Capacity = $Capacity;

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

    public function getFacebook(): ?string
    {
        return $this->Facebook;
    }

    public function setFacebook(string $Facebook): static
    {
        $this->Facebook = $Facebook;

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

    public function getEventDatetime(): ?\DateTimeImmutable
    {
        return $this->eventDatetime;
    }

    public function setEventDatetime(\DateTimeImmutable $eventDatetime): static
    {
        $this->eventDatetime = $eventDatetime;

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

}
