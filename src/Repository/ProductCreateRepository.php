<?php

namespace App\Repository;


use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ProductCreateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
    public function getProducts(): ?array
    {
        return $this->findBy(['recordState' => 0]);
    }

    public function getProductById(string $productId)
    {
        return $this->findOneBy(['id' => $productId, 'recordState' => 0]);
    }
}
