<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Service\StaticHelper;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route(path: '/category-admin', name: 'category_admin')]
    public function category_admin(Request $request, PaginatorInterface $paginator,CategoryRepository $categoryRepository): Response
    {
        $filters = StaticHelper::filters($request);

        $query = $categoryRepository->getCategories($filters);

        $categoryLists = $paginator->paginate($query, $request->query->getInt('page', 1), 10);

        $params = [
            'status'=>true,
            'categoryLists' => $categoryLists,
            'query' => $categoryLists,
            'pagination' => $categoryLists,
            'recordsPerPage' => $filters['recordsPerPage'],
        ];
        if($request->isXmlHttpRequest()) {
            return $this->render('tables/category_table.html.twig',$params);
        }

        return $this->render('admin/category_admin.html.twig',$params);
    }
    #[Route(path: '/category-create', name: 'category_create')]
    public function category_create(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

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
    #[Route(path: '/update-category/{id}', name: 'update_category')]
    public function update_category(Request $request,CategoryRepository $categoryRepository, EntityManagerInterface $em, string $id): Response
    {
        $category = $categoryRepository->find(['id' => $id]);
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('category_admin');
        }
        return $this->render('/admin/category_update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route(path:'/delete-category/{id}', name: 'delete_category')]
    public function delete_category(CategoryRepository $categoryRepository,EntityManagerInterface $em,string $id): Response
    {
        $category = $categoryRepository->find(['id' => $id]);
        $category->setRecordState(1);
        $em->persist($category);
        $em->flush();
        return $this->redirectToRoute('category_admin');
    }

}
