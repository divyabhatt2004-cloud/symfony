<?php

namespace App\Repository;

use App\Entity\Todolist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Todolist>
 */
class TodolistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todolist::class);
    }

    public function getTodoLists(): ?array
    {
        return $this->findBy(['recordState' => 0]);
    }

    public function getTodoListById(string $todoListId)
    {
        return $this->findOneBy(['id' => $todoListId, 'recordState' => 0]);
    }
}
