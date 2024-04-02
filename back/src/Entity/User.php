<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['user:index','user:show','user:create','user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['user:index','user:show','user:create','user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[Groups(['user:show','user:create','user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[Groups(['user:show','user:create','user:update'])]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[Groups(['user:create'])]
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Artist::class)]
    private Collection $artists;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Scene::class)]
    private Collection $scenes;

    #[Groups(['user:create','user:update','scene:show'])]
    #[ORM\ManyToMany(targetEntity: Scene::class, inversedBy: 'users')]
    private Collection $scene;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->scenes = new ArrayCollection();
        $this->scene = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

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
            $artist->setUser($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getUser() === $this) {
                $artist->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Scene>
     */
    public function getScenes(): Collection
    {
        return $this->scenes;
    }

    public function addScene(Scene $scene): self
    {
        if (!$this->scene->contains($scene)) {
            $this->scene[] = $scene;
            $scene->addUser($this);
        }
    
        return $this;
    }
    
    public function removeScene(Scene $scene): self
    {
        if ($this->scene->removeElement($scene)) {
            $scene->removeUser($this);
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

    public function eraseCredentials() :void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

}
