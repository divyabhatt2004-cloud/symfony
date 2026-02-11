<?php

namespace App\Entity;

use App\Entity\AbstractEntity;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'category')]
#[ORM\Entity(repositoryClass:CategoryRepository::class)]

class Category extends AbstractEntity
{
    #[ORM\Column(nullable: true)]
    private ?string $name = null;
    #[ORM\Column(nullable: true)]
    private ?string $description = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function __toString(): string
    {
        return (string) $this->getName();
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
