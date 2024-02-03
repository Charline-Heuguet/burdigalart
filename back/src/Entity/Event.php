<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EventRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource(
    operations: [
        new GetCollection(),// Tout le monde peut voir les événements.
        new Get(), // Tout le monde peut voir l'événement.
        new Post(
            security: 'is_granted("ROLE_MANAGER")',// Seul un gérant de scène peut créer un événement.
            securityMessage: 'Seuls les gérants de scène peuvent créer un événement.'
        ),
        new Put(
            security: 'object.getScene().getUser() == user', // Seul le gérant de la scène peut modifier l'événement.
        ),
        new Delete(
            security: 'object.getScene().getUser() == user', // Seul le gérant de la scène peut supprimer l'événement.
        ),
    ]
)]

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $DateTime = null;

    #[ORM\Column(length: 255)]
    private ?string $EventPhoto = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\ManyToOne(targetEntity:Scene::class , inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Scene $scene = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, mappedBy: 'events')]
    private Collection $artists;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'events')]
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

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->DateTime;
    }

    public function setDateTime(\DateTimeInterface $DateTime): static
    {
        $this->DateTime = $DateTime;

        return $this;
    }

    public function getEventPhoto(): ?string
    {
        return $this->EventPhoto;
    }

    public function setEventPhoto(string $EventPhoto): static
    {
        $this->EventPhoto = $EventPhoto;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getScene(): ?Scene
    {
        return $this->scene;
    }

    public function setScene(?Scene $scene): static
    {
        $this->scene = $scene;

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
            $artist->addEvent($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            $artist->removeEvent($this);
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
            $user->addEvent($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeEvent($this);
        }

        return $this;
    }

}
