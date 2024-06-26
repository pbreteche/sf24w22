<?php

namespace App\Entity;

use App\Entity\Enum\ClothSize;
use App\Repository\TShirtRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotNull;

#[ORM\Entity(repositoryClass: TShirtRepository::class)]
class TShirt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $referenceNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column(enumType: ClothSize::class)]
    private ?ClothSize $size = null;

    #[ORM\ManyToOne]
    private ?Brand $brand = null;

    #[ORM\Column(type: 'simple_array', nullable: true)]
    private array $tags = [];

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function setReferenceNumber(string $referenceNumber): static
    {
        $this->referenceNumber = $referenceNumber;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getSize(): ?ClothSize
    {
        return $this->size;
    }

    public function setSize(ClothSize $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function addTag(string $tag): static
    {
        $this->tags[] = $tag;
        $this->tags = array_unique($this->tags);

        return $this;
    }

    public function removeTag(string $tag): static
    {
        $pos = array_search($tag, $this->tags);
        if (false !== $pos) {
            unset($this->tags[$pos]);
        }

        return $this;
    }
}
