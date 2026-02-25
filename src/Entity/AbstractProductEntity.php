<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
#[HasLifecycleCallbacks]
abstract class AbstractProductEntity extends AbstractEntity
{

    #[ORM\Column(nullable: true)]
    protected ?string $name = null;

    #[ORM\Column(nullable: true)]
    protected ?string $image = null;
    protected ?string $imageFile = null;

    #[ORM\Column(nullable: true)]
    protected ?string $description = null;

    #[ORM\Column(nullable: true)]
    protected ?int $quantity = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    protected ?Category $category = null;

    #[ORM\Column(nullable: true)]
    protected ?int $price = null;

    #[ORM\Column(nullable: true)]
    protected ?int $gst = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function setImageFile(?string $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getGst(): ?int
    {
        return $this->gst;
    }

    public function setGst(?int $gst): self
    {
        $this->gst = $gst;
        return $this;
    }
}

