<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
class CartProductController extends AbstractController
{
    #[Route(path: '/product-cart', name: 'product_cart')]
    public function product_cart(): Response
    {
        return $this->render('product_cart.html.twig');
    }
    #[Route(path: '/add-to-cart/{id}', name: 'add_to_cart')]
    public function add_to_cart(): Response
    {
        return $this->render('product_cart.html.twig');
    }

}
