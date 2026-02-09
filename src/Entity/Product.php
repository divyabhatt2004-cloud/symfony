<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product')]
#[ORM\Entity(repositoryClass:ProductRepository::class)]

class Product extends AbstractProductEntity
{
    #[ORM\Column(type: Types::INTEGER, nullable: true, options: ['default' => 0])]
    private ?int $wishlist = 0;

    public function getWishlist(): ?int
    {
        return $this->wishlist;
    }

    public function setWishlist(?int $wishlist): self
    {
        $this->wishlist = $wishlist;
        return $this;
    }
}
