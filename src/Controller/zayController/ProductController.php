<?php

namespace App\Controller\zayController;
use App\Entity\zayEntity\Product;
use App\Form\zayForm\ProductCreateForm;
use App\Repository\zayRepository\ProductCreateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
class ProductController extends AbstractController
{
    #[Route(path: '/product-admin', name: 'product_admin')]
    public function product_admin(ProductCreateRepository $productRepository): Response
    {
        $productList = $productRepository->findBy(['recordState' => '0']);
        return $this->render('admin/product_admin.html.twig', [
            'productLists' => $productList,
        ]);
    }
    #[Route(path: '/product-create', name: 'product_create')]
    public function product_create(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductCreateForm::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_admin');
        }
        return $this->render('admin/product_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route(path: '/update-product/{id}', name: 'update-product')]
    public function update_product(Request $request,ProductCreateRepository $productRepository, EntityManagerInterface $em, string $id): Response
    {
        $product = $productRepository->find(['id' => $id]);
        $form = $this->createForm(ProductCreateForm::class, $product);

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
    #[Route(path:'/delete-product/{id}', name: 'delete-product')]
    public function delete_product(ProductCreateRepository $productRepository,EntityManagerInterface $em,string $id): Response
    {
        $product = $productRepository->find(['id' => $id]);
        $product->setRecordState(1);
        $em->persist($product);
        $em->flush();
        return $this->redirectToRoute('product_admin');
    }
}
