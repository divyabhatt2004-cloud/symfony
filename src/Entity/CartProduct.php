<?php

namespace App\Entity;

use App\Repository\CartProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'CartProduct')]
#[ORM\Entity(repositoryClass: CartProductRepository::class)]
class CartProduct extends AbstractProductEntity
{
    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Product $product;

    public function getProduct(): ?Product
    {
        return $this->product;
    }
    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    #[ORM\Column(nullable: true)]
    private ?string $product_id = null;

    public function getProductId(): ?string
    {
        return $this->product_id;
    }

    public function setProductId(?string $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }

}
