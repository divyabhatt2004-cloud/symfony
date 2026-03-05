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
    public function getCategories(?array $filters = []): ?array
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.recordState =:recordState')
            ->setParameter('recordState', 0);

        if (isset($filters['sort']) && $filters['sort'] && $filters['direction']) {

            $query->orderBy($filters['sort'], $filters['direction']);
        } else {
            $query->orderBy('c.id', 'DESC');
        }

        if(isset($filters['search']) && $filters['search'])
        {
            $query->andWhere('c.name LIKE :search')
                ->setParameter('search', '%'.$filters['search'].'%');
        }

        return $query->getQuery()->getResult();
    }

    public function getCategoryById(string $id)
    {
        return $this->findOneBy(['id' => $id, 'recordState' => 0]);
    }
}
