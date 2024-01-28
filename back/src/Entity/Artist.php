<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

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

    #[ORM\Column(length: 255)]
    private ?string $OfficialPhoto = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOfficialPhoto(): ?string
    {
        return $this->OfficialPhoto;
    }

    public function setOfficialPhoto(string $OfficialPhoto): static
    {
        $this->OfficialPhoto = $OfficialPhoto;

        return $this;
    }
}
