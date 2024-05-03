<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Artist;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event:index', 'event:show', 'event:create','event:update', 'event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show','scene:index','scene:create', 'scene:show', 'scene:update'])]
    private ?int $id = null;

    #[Groups(['event:index', 'event:show', 'event:create','event:update', 'event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show','scene:index','scene:create', 'scene:show', 'scene:update'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[Groups(['event:index', 'event:show', 'event:create','event:update','user:show','user:create','user:update','artist:index', 'artist:show','scene:index','scene:create', 'scene:show', 'scene:update'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Groups(['event:index', 'event:show', 'event:create','event:update','event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show','scene:index','scene:create', 'scene:show', 'scene:update'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $dateTime = null;

    #[Groups(['event:index', 'event:show', 'event:create','event:update','event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show','scene:index','scene:create', 'scene:show', 'scene:update'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster = null;

    #[Groups(['event:index', 'event:show', 'event:create','event:update','user:show','user:create','user:update','artist:index', 'artist:show','scene:index','scene:create', 'scene:show', 'scene:update'])]
    #[ORM\Column]
    private ?float $price = null;
    
    #[Groups(['event:index', 'event:show', 'event:create','event:update','event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show','scene:index','scene:create', 'scene:show', 'scene:update'])]
    #[ORM\Column(length: 255,nullable: true)]
    private ?string $slug = null;

    #[Groups(['event:show','event:update', 'event:upcoming'])]
    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'events')]
    private Collection $Artist;

    #[Groups(['event:index', 'event.create', 'event:show', 'event:update', 'event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show'])]
    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Scene $scene = null;

    #[Groups(['event:index', 'event:show', 'event:upcoming'])]
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'events')]
    private Collection $user;

    public function __construct()
    {
        $this->Artist = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
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

    public function getDateTime(): ?\DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeImmutable $dateTime): static
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtist(): Collection
    {
        return $this->Artist;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->Artist->contains($artist)) {
            $this->Artist->add($artist);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        $this->Artist->removeElement($artist);

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
        if ($this->title) {
            $this->slug = $this->createSlug($this->title);
        }
    }

private function createSlug(string $name): string
{
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
    $slug = strtolower(trim($slug, '-'));
    return $slug;
}

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }

}
