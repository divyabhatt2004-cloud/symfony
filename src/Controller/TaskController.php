<?php

namespace App\Controller;

use App\Entity\zayEntity\Product;
use App\Form\ProductCreateForm;
use App\Repository\ProductCreateRepository;

use App\Entity\zayEntity\UserContact;
use App\Form\UserContactForm;
use App\Repository\UserContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class TaskController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route(path: '/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route(path: '/shop', name: 'shop')]
    public function shop(): Response
    {
        return $this->render('shop.html.twig');
    }

    #[Route(path: '/contact', name: 'contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $user = new UserContact();
        $form = $this->createForm(UserContactForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route(path: '/support-admin', name: 'support_admin')]
    public function support_admin(UserContactRepository $UserSupportRepository): Response
    {
        $userSupportList = $UserSupportRepository->findBy(['recordState' => '0']);
        return $this->render('admin/support_admin.html.twig', [
            'userSupportLists' => $userSupportList,
        ]);
    }
    #[Route(path: '/edit-user-request/{id}', name: 'edit-user-request')]
    public function edit_user_request(Request $request,UserContactRepository $editUserRepository, EntityManagerInterface $em, string $id): Response
    {
        $user = $editUserRepository->find(['id' => $id]);
        $form = $this->createForm(UserContactForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('support_admin');
        }
        return $this->render('contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path:'/delete-user-request/{id}', name: 'delete-user-request')]
    public function delete_user_request(UserContactRepository $deleteUserRepository,EntityManagerInterface $em,string $id): Response
    {
        $user = $deleteUserRepository->find(['id' => $id]);
        $user->setRecordState(1);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('support_admin');
    }

    #[Route(path: '/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('admin/admin.html.twig');
    }
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
    public function editTodoList(Request $request,ProductCreateRepository $productRepository, EntityManagerInterface $em, string $id): Response
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
    #[Route(path: '/category-admin', name: 'category_admin')]
    public function categories_admin(): Response
    {
        return $this->render('admin/category_admin.html.twig');
    }
    #[Route(path: '/category-create', name: 'category_create')]
    public function category_create(): Response
    {
        $Category = new Category();
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


}
