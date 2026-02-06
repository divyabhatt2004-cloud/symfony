<?php

namespace App\Entity;

use App\Repository\CartProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'cart_product')]
#[ORM\Entity(repositoryClass: CartProductRepository::class)]
class CartProduct extends AbstractProductEntity
{

    #[ORM\Column(nullable: true)]
    private ?string $productId = null;

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(?string $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

}
