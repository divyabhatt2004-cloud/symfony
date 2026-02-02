<?php

namespace App\Entity;

use App\Repository\TodolistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'todo_lists')]
#[ORM\Entity(repositoryClass: TodolistRepository::class)]
class Todolist extends AbstractEntity
{

    #[ORM\Column]
    private ?string $title = null;

    #[ORM\Column]
    private ?string $description = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;

    }


}
