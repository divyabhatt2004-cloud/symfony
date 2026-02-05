<?php

namespace App\Repository;

use App\Entity\CartProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
class CartProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartProduct::class);
    }
    public function getCartProducts(): ?array
    {
        return $this->findBy(['recordState' => 0]);
    }

    public function getCartProductById(string $productId)
    {
        return $this->findOneBy(['id' => $productId, 'recordState' => 0]);
    }
}
