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
    #[Route(path: '/productCart-table', name: 'productCartTable')]
    public function productCartTable(CartProductRepository $productCartRepository): Response
    {
        $productCartList = $productCartRepository->getCartProducts();

        return $this->render('tables/product_cartTable.html.twig', [
            'productCartLists' => $productCartList,
        ]);
    }

    #[Route(path: '/add-to-cart/{id}', name: 'add_to_cart')]
    public function add_to_cart(ProductRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $product = $productRepository->getProductById($id);
        if (!$product) {
            return $this->json(['status' => false, 'msg' => 'Product not found']);
        }
        $cartProduct = new CartProduct();

        $cartProduct->setProductId($product->getId());
        $cartProduct->setProductName($product->getProductName());
        $cartProduct->setProductImage($product->getProductImage());
        $cartProduct->setProductDescription($product->getProductDescription());
        $cartProduct->setCategory($product->getCategory());
        $cartProduct->setPrice($product->getPrice());
        $cartProduct->setGst($product->getGst());
        $cartProduct->setQuantity(1);
        $em->persist($cartProduct);
        $em->flush();
        return $this->json(['status' => true, 'msg' => 'add to cart success','errorMsg'=>'add to cart failed']);

    }
    #[Route(path: '/delete-from-cart/{id}', name: 'delete_from_cart')]
    public function delete_from_cart(CartProductRepository $productCartRepository, EntityManagerInterface $em, string $id): Response
    {
        $cartProduct = $productCartRepository->find(['id' => $id]);
        $cartProduct->setRecordState(1);
        $em->persist($cartProduct);
        $em->flush();
        return $this->redirectToRoute('product_cart');
    }
}
