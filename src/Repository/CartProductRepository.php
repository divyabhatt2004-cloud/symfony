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
            $query->andWhere('cp.name LIKE :search')
                ->setParameter('search','%'.$filters['search'].'%');
        }

        return $query->getQuery()->getResult();
    }

    public function getCartProductById(string $productId)
    {
        return $this->findOneBy(['productId' => $productId, 'recordState' => 0]);
    }

    public function countProducts(): int
    {
        return (int) $this->createQueryBuilder('p')
            ->select('SUM(p.quantity)')
            ->where('p.quantity > :qty')
            ->setParameter('qty', 0)
            ->getQuery()
            ->getSingleScalarResult();
    }
     public function total(): array
     {
        $subTotal= $this->createQueryBuilder('cp')
            ->select('SUM(cp.quantity * cp.price)')
            ->where('cp.recordState =:recordState')
            ->setParameter('recordState',0)
            ->getQuery()
            ->getSingleScalarResult();

         $gst = $this->createQueryBuilder('cp')
             ->select('SUM(((cp.quantity * cp.price) * cp.gst)/100)')
             ->where('cp.recordState =:recordState')
             ->setParameter('recordState',0)
             ->getQuery()
             ->getSingleScalarResult();

         return ['subtotal'=>$subTotal,'gst'=>$gst,'total'=>$subTotal+$gst];
     }
}
