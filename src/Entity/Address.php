<?php

namespace App\Entity;

use App\Enum\NumberComplement;
use App\Enum\WayType;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?NumberComplement $numberComplement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?WayType $wayType = null;

    #[ORM\Column(length: 255)]
    private ?string $wayName = null;

    #[ORM\Column(length: 255)]
    private ?string $zip = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $complement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getNumberComplement(): ?NumberComplement
    {
        return $this->numberComplement;
    }

    public function setNumberComplement(?NumberComplement $numberComplement): static
    {
        $this->numberComplement = $numberComplement;

        return $this;
    }

    public function getWayType(): ?WayType
    {
        return $this->wayType;
    }

    public function setWayType(?WayType $wayType): static
    {
        $this->wayType = $wayType;

        return $this;
    }

    public function getWayName(): ?string
    {
        return $this->wayName;
    }

    public function setWayName(string $wayName): static
    {
        $this->wayName = $wayName;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): static
    {
        $this->complement = $complement;

        return $this;
    }

    public function isEmpty(): bool
    {
        return null === $this->wayName
               && null === $this->zip
               && null === $this->city;
    }

    public function __toString()
    {
        return sprintf(
            "%d %s, %s %s\n%s %s",
            $this->number,
            $this->numberComplement?->value ?? '',
            $this->wayType?->value ?? '',
            $this->wayName,
            $this->zip,
            $this->city
        );
    }
}
