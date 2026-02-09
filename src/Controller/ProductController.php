<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Service\FileUpload;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route(path: '/product-admin', name: 'product_admin')]
    public function product_admin(): Response
    {
        return $this->render('admin/product_admin.html.twig');
    }
    #[Route(path: '/product-table', name: 'product_table')]
    public function productTable(ProductRepository $productRepository): Response
    {
        $productList = $productRepository->getProducts();

        return $this->render('tables/product_table.html.twig', [
            'productLists' => $productList,
        ]);
    }

    #[Route(path: '/product-create', name: 'product_create')]
    public function product_create(Request $request,FileUpload $fileUpload,EntityManagerInterface $em): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('productImage')->getData();

            if ($imageFile) {
                $fileName = $fileUpload->uploadFile('product', $imageFile);
                $product->setProductImage($fileName);
            }

            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_admin');
        }
        return $this->render('admin/product_create.html.twig', [
            'form' => $form->createView(),'editProduct' => $product,
        ]);
    }

    #[Route(path: '/update-product/{id}', name: 'update_product')]
    public function update_product(Request $request, FileUpload $fileUpload,Product $editProduct, ProductRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $product = $productRepository->find(['id' => $id]);
        $form = $this->createForm(ProductType::class, $product, [
            'id' => $id, ]);// Pass the condition as a form option

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('productImage')->getData();
            if ($imageFile) {
                $fileName = $fileUpload->uploadFile('product', $imageFile);
                $product->setProductImage($fileName);
            }
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_admin');
        }
        return $this->render('/admin/product_update.html.twig', [
            'form' => $form->createView(),'editProduct' => $editProduct,
        ]);
    }

    #[Route(path: '/delete-product/{id}', name: 'delete_product')]
    public function delete_product(ProductRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $product = $productRepository->find(['id' => $id]);
        $product->setRecordState(1);
        $em->persist($product);
        $em->flush();
        return $this->redirectToRoute('product_admin');
    }
    #[Route(path: '/product-details/{id}', name: 'product_details')]
    public function product_details(ProductRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $productList = $productRepository->getProductById($id);
        return $this->render('product_details.html.twig',[
            'productLists' => $productList,
        ]);
    }
    #[Route(path: '/add-to-wishlist/{id}', name: 'add_to_wishlist')]
    public function add_to_wishlist(ProductRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $product = $productRepository->find(['id' => $id]);
        $product->setWishlist(1);
        $em->persist($product);
        $em->flush();
        return $this->json(['status' => true, 'msg' => 'add to wishlist success','errorMsg'=>'add to wishlist failed']);
    }
    #[Route(path: '/remove-from-wishlist/{id}', name: 'remove_from_wishlist')]
    public function remove_from_wishlist(ProductRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $product = $productRepository->find(['id' => $id]);
        $product->setWishlist(0);
        $em->persist($product);
        $em->flush();
        return $this->json(['status' => true, 'msg' => 'remove from wishlist success','errorMsg'=>'remove from wishlist failed']);
    }
}
