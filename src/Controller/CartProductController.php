<?php

namespace App\Controller;

use App\Entity\CartProduct;
use App\Repository\CartProductRepository;
use App\Repository\ProductRepository;
use App\Service\StaticHelper;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartProductController extends AbstractController
{
    #[Route(path: '/product-cart', name: 'product_cart')]
    public function product_cart(Request $request,paginatorInterface $paginator, CartProductRepository $productCartRepository): Response
    {
        $filters = StaticHelper::filters($request);

        $query = $productCartRepository->getCartProducts($filters);

        $productCartLists = $paginator->paginate($query,$request->query->getInt('page',1),10);

        $params = [
            'status'=> true,
            'productCartLists'=>$productCartLists,
            'query'=>$productCartLists,
            'pagination'=>$productCartLists,
            'recordsPerPage'=>$filters['recordsPerPage'],
        ];

        if($request->isXmlHttpRequest()){
            return $this->render('tables/product_cartTable.html.twig',$params);
        }
        return $this->render('product_cart.html.twig',$params);
    }



    #[Route(path: '/add-to-cart', name: 'add_to_cart')]
    public function add_to_cart(Request $request, CartProductRepository $productCartRepository, ProductRepository $productRepository, EntityManagerInterface $em): Response
    {
        $id = $request->request->get('productId');
        $quantity = $request->request->get('quantity') ?? 1;

        $cartProduct = $productCartRepository->getCartProductById($id);
        if ($cartProduct) {
            $cartProductQuantity = $cartProduct->getQuantity();
            $cartProduct->setQuantity($cartProductQuantity+$quantity);
        } else {
            $product = $productRepository->getProductById($id);

            if (!$product) {
                return $this->json(['status' => false, 'msg' => 'Product not found']);
            }

            $cartProduct = new CartProduct();
            $cartProduct->setProductId($product->getId());
            $cartProduct->setName($product->getName());
            $cartProduct->setImage($product->getImage());
            $cartProduct->setDescription($product->getDescription());
            $cartProduct->setCategory($product->getCategory());
            $cartProduct->setPrice($product->getPrice());
            $cartProduct->setGst($product->getGst());
            $cartProduct->setQuantity($quantity);
        }
        $em->persist($cartProduct);
        $em->flush();
        return $this->json(['status' => true, 'msg' => 'add to cart success', 'errorMsg' => 'add to cart failed']);

    }

    #[Route(path: '/delete-from-cart/{id}', name: 'delete_from_cart')]
    public function delete_from_cart(CartProductRepository $productCartRepository, EntityManagerInterface $em, string $id): Response
    {
        $cartProduct = $productCartRepository->find(['id' => $id]);
//        $cartProduct->setRecordState(1);
        $em->remove($cartProduct);
        $em->flush();
        return $this->redirectToRoute('product_cart');
    }
}
