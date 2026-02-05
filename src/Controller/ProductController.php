<?php

namespace App\Controller;

use App\Entity\ZayEntity\Product;
use App\Form\zayForm\ProductType;
use App\Repository\ZayRepository\ProductCreateRepository;
use App\Service\FileUpload;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route(path: '/product-admin', name: 'product_admin')]
    public function product_admin(ProductCreateRepository $productRepository): Response
    {
        return $this->render('admin/product_admin.html.twig');
    }
    #[Route(path: '/product-table', name: 'product_table')]
    public function todoListTable(Request $request, ProductCreateRepository $productRepository): Response
    {
        $productList = $productRepository->getProducts();

        return $this->render('product_table.html.twig', [
            'productLists' => $productList,
        ]);
    }

    #[Route(path: '/product-create', name: 'product_create')]
    public function product_create(Request $request, FileUpload $fileUpload, EntityManagerInterface $em): Response
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
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/update-product/{id}', name: 'update-product')]
    public function update_product(Request $request, ProductCreateRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $product = $productRepository->find(['id' => $id]);
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_admin');
        }
        return $this->render('/admin/product_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/delete-product/{id}', name: 'delete-product')]
    public function delete_product(ProductCreateRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $product = $productRepository->find(['id' => $id]);
        $product->setRecordState(1);
        $em->persist($product);
        $em->flush();
        return $this->redirectToRoute('product_admin');
    }
}
