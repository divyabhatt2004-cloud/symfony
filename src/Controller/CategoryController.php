<?php

namespace App\Controller;

use App\Entity\zayEntity\Category;
use App\Form\CategoryForm;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route(path: '/category-admin', name: 'category_admin')]
    public function categories_admin(): Response
    {
        return $this->render('admin/category_admin.html.twig');
    }
    #[Route(path: '/category-create', name: 'category_create')]
    public function category_create(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryForm::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('category_admin');
        }
        return $this->render('admin/category_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route(path: '/update-category/{id}', name: 'update-category')]
    public function editTodoList(Request $request,CategoryRepository $categoryRepository, EntityManagerInterface $em, string $id): Response
    {
        $category = $categoryRepository->find(['id' => $id]);
        $form = $this->createForm(CategoryForm::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('category_admin');
        }
        return $this->render('/admin/category_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route(path:'/delete-product/{id}', name: 'delete-product')]
    public function delete_product(CategoryRepository $categoryRepository,EntityManagerInterface $em,string $id): Response
    {
        $category = $categoryRepository->find(['id' => $id]);
        $category->setRecordState(1);
        $em->persist($category);
        $em->flush();
        return $this->redirectToRoute('category_admin');
    }
}
