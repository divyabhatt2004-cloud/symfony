<?php

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\UserContact;
use Doctrine\Persistence\ManagerRegistry;


class UserContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserContact::class);
    }
    public function getUserRequests(?array $filters =[]): ?array
    {
        $query = $this->createQueryBuilder('ur')
            ->where('ur.recordState =:recordState')
            ->setParameter('recordState', 0);

        if(isset($filters['sort']) && $filters['sort'] && $filters['direction']){
             $query->orderBy($filters['sort'], $filters['direction']);
        }
        else
        {
            $query->orderBy('ur.id', 'DESC');
        }
        if(isset($filters['search']) && $filters['search']){

            $query->andwhere('ur.name like :search')
                ->setParameter('search', '%'.$filters['search'].'%');
        }
        return $query->getQuery()->getResult();
    }

    public function getUserRequestById(string $id)
    {
        return $this->findOneBy(['id' => $id, 'recordState' => 0]);
    }
}
