<?php

namespace App\Entity;

use App\Repository\StyleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StyleRepository::class)]
class Style
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $StyleName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStyleName(): ?string
    {
        return $this->StyleName;
    }

    public function setStyleName(string $StyleName): static
    {
        $this->StyleName = $StyleName;

        return $this;
    }
}
