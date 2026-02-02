<?php

namespace App\Entity\zayEntity;

use App\Entity\AbstractEntity;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:CategoryRepository::class)]
class Category extends AbstractEntity
{

    #[ORM\Column(nullable: true)]
    private ?string $categoryName = null;
    #[ORM\Column(nullable: true)]
    private ?string $categoryType = null;
    #[ORM\Column(nullable: true)]
    private ?string $categoryDescription = null;

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(?string $categoryName): self
    {
        $this->categoryName = $categoryName;
        return $this;
    }
    public function getCategoryType(): ?string
    {
        return $this->categoryType;
    }

    public function setCategoryType(?string $categoryType): self
    {
        $this->categoryType = $categoryType;
        return $this;
    }
    public function getCategoryDescription(): ?string
    {
        return $this->categoryDescription;
    }

    public function setCategoryDescription(?string $categoryDescription): self
    {
        $this->categoryDescription = $categoryDescription;
        return $this;
    }
}
