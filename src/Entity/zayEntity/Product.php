<?php

namespace App\Entity\zayEntity;

use App\Entity\AbstractEntity;
use App\Repository\ProductCreateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product')]
#[ORM\Entity(repositoryClass:ProductCreateRepository::class)]
class Product extends AbstractEntity
{
    #[ORM\Column(nullable: true)]
    private ?string $productName = null;
    #[ORM\Column(nullable: true)]
    private ?string $productImage = null;
    #[ORM\Column(nullable: true)]
    private ?string $productDescription = null;
    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;
    #[ORM\ManyToOne(targetEntity: Category::class)]
    private ?Category $category = null;
    #[ORM\Column(nullable: true)]
    private ?int $price = null;
    #[ORM\Column(nullable: true)]
    private ?int $gst = null;

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(?string $productName): self
    {
        $this->productName = $productName;
        return $this;
    }
    public function getProductImage(): ?string
    {
        return $this->productImage;
    }

    public function setProductImage(?string $productImage): self
    {
        $this->productImage = $productImage;
        return $this;
    }
    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    public function setProductDescription(?string $productDescription): self
    {
        $this->productDescription = $productDescription;
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
