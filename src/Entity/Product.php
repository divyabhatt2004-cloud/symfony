<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product')]
#[ORM\Entity(repositoryClass:ProductRepository::class)]

class Product extends AbstractProductEntity
{

}
