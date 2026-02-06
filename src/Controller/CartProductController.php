<?php

namespace App\Controller;

use App\Entity\CartProduct;
use App\Repository\CartProductRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function add_to_cart(ProductRepository $productRepository,CartProductRepository $cartProductRepository, EntityManagerInterface $em, string $id): Response
    {
//        $product = $productRepository->find(['id' => $id]);
        $product = $productRepository->getProductById($id);
//        dd($product);
        $cartProduct = new CartProduct();

        $cartProduct->setProduct($product);
        $cartProduct->setQuantity(1);
        $cartProduct->setRecordState(0);
        $em->persist($cartProduct);
        $em->flush();
        return $this->redirectToRoute('shop');

    }

}
