<?php

namespace App\Repository;


use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProducts(?array $filters = []): ?array
    {

        $query = $this->createQueryBuilder('p')
            ->where('p.recordState = :recordState')
            ->setParameter('recordState', 0);


        if (isset($filters['sort']) && $filters['sort'] && $filters['direction']) {
            $query->orderBy($filters['sort'], $filters['direction']);
        } else {
            $query->orderBy('p.id', 'DESC');
        }

        if(isset($filters['search']) && $filters['search'])
        {
            $query->andWhere('p.productName LIKE :search')
            ->setParameter('search', '%'.$filters['search'].'%');
        }

        return $query->getQuery()->getResult();
    }

    public function getProductById(string $productId): ?Product
    {
        return $this->findOneBy(['id' => $productId]);
    }
}
