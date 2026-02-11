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
    public function getCartProducts(?array $filters =[]): ?array
    {
        $query = $this->createQueryBuilder('cp')
            ->where('cp.recordState =:recordState')
            ->setParameter('recordState',0);

        if (isset($filters['sort']) && $filters['sort'] && $filters['direction']){
            $query->orderBy($filters['sort'],$filters['direction']);
        }else
        {
            $query->orderBy('cp.id', 'DESC');
        }

        if(isset($filters['search']) && $filters['search']){
            $query->andWhere('cp.productName LIKE :search')
                ->setParameter('search','%'.$filters['search'].'%');
        }

        return $query->getQuery()->getResult();
    }

    public function getCartProductById(string $productId)
    {
        return $this->findOneBy(['id' => $productId, 'recordState' => 0]);
    }
}
