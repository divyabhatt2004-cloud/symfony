<?php

namespace App\Entity\zayEntity;

use App\Entity\AbstractEntity;
use App\Repository\ProductCreateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:ProductCreateRepository::class)]
class ProductCreate extends AbstractEntity
{

    #[ORM\Column(nullable: true)]
    private ?string $product_name = null;
    #[ORM\Column(nullable: true)]
    private ?string $product_image = null;
    #[ORM\Column(nullable: true)]
    private ?string $product_description = null;
    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;
    #[ORM\Column(nullable: true)]
    private ?string $category = null;
    #[ORM\Column(nullable: true)]
    private ?int $price = null;
    #[ORM\Column(nullable: true)]
    private ?int $gst = null;

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(?string $product_name): self
    {
        $this->product_name = $product_name;
        return $this;
    }
    public function getProductImage(): ?string
    {
        return $this->product_image;
    }

    public function setProductImage(?string $product_image): self
    {
        $this->product_image = $product_image;
        return $this;
    }
    public function getProductDescription(): ?string
    {
        return $this->product_description;
    }

    public function setProductDescription(?string $product_description): self
    {
        $this->product_description = $product_description;
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
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
