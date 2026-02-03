<?php

namespace App\Entity\zayEntity;

use App\Entity\AbstractEntity;
use App\Repository\ProductCreateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'Cart_product')]
#[ORM\Entity(repositoryClass: ProductCreateRepository::class)]
class CartProduct extends AbstractEntity
{
    #[ORM\Column(nullable: true)]
    private ?string $productName = null;
    #[ORM\Column(nullable: true)]
    private ?string $productImage = null;
    #[ORM\Column(nullable: true)]
    private ?string $productDescription = null;
    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;
    #[ORM\Column(nullable: true)]
    private ?int $price = null;
    #[ORM\Column(nullable: true)]
    private ?int $gst = null;
}
