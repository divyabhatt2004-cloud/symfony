<?php

namespace App\Repository\ZayRepository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\ZayEntity\UserContact;
use Doctrine\Persistence\ManagerRegistry;


class UserContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserContact::class);
    }
}
