<?php

namespace App\Entity;

use App\Repository\CartProductRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Table(name: 'CartProduct')]
#[ORM\Entity(repositoryClass:CartProductRepository::class)]

class CartProduct extends AbstractProductEntity
{

}
