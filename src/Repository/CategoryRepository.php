<?php

namespace App\Repository;


use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }
    public function getCategories(): ?array
    {
        return $this->findBy(['recordState' => 0]);
    }

    public function getCategoryById(string $productId)
    {
        return $this->findOneBy(['id' => $productId, 'recordState' => 0]);
    }
}
