<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SceneRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SceneRepository::class)]
class Scene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event:create'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['scene:show', 'scene:create', 'scene:update'])]
    private ?int $siret = null;

    #[Groups(['scene:index', 'scene:show', 'scene:create', 'scene:update'])]
    #[ORM\Column(length: 255)]
    private ?string $banner = null;

    #[Groups(['scene:index', 'scene:show', 'scene:create', 'scene:update','artist_scene:show','event:index', 'event:show', 'event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['scene:index', 'scene:show', 'scene:create', 'scene:update', 'artist_scene:show', 'event:index', 'event:show', 'event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show' ])]
    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[Groups(['scene:index', 'scene:show', 'scene:create', 'scene:update', 'artist_scene:show','event:index', 'event:show','event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show' ])]
    #[ORM\Column]
    private ?int $zipcode = null;

    #[Groups(['scene:index', 'scene:show', 'scene:create', 'scene:update', 'artist_scene:show','event:index', 'event:show', 'event:upcoming','user:show','user:create','user:update','artist:index', 'artist:show'])]
    #[ORM\Column(length: 255)]
    private ?string $town = null;

    #[Groups(['scene:show', 'scene:create', 'scene:update'])]
    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[Groups(['scene:show', 'scene:create', 'scene:update'])]
    #[ORM\Column]
    private ?int $capacity = null;

    #[Groups(['scene:show', 'scene:create', 'scene:update'])]
    #[ORM\Column(length: 255)]
    private ?string $instagram = null;

    #[Groups(['scene:show', 'scene:create', 'scene:update'])]
    #[ORM\Column(length: 255)]
    private ?string $facebook = null;

    #[Groups(['scene:index','scene:show','scene:create', 'scene:update'])]
    #[ORM\Column]
    private ?bool $subscription = null;

    #[Groups(['scene:index','scene:create', 'scene:show', 'scene:update', 'scene:upcoming', 'event:upcoming'])]
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'scenes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'scene', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'scene', targetEntity: Message::class)]
    private Collection $messages;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->messages = new ArrayCollection();
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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
            $event->setScene($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getScene() === $this) {
                $event->setScene(null);
            }
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
            $message->setScene($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getScene() === $this) {
                $message->setScene(null);
            }
        }

        return $this;
    }
}
