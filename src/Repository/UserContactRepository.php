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
    public function getUserRequests(): ?array
    {
        return $this->findBy(['recordState' => 0]);
    }

    public function getUserRequestById(string $productId)
    {
        return $this->findOneBy(['id' => $productId, 'recordState' => 0]);
    }
}
