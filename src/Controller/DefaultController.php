<?php

namespace App\Controller;


use App\Repository\ZayRepository\CategoryRepository;
use App\Repository\ZayRepository\ProductCreateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    public function index(): Response
    {
        return $this->render('zay-pages/index.html.twig');
    }

    #[Route(path: '/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('zay-pages/about.html.twig');
    }
    #[Route(path: '/shop', name: 'shop')]
    public function shop(CategoryRepository $categoryRepository,ProductCreateRepository $productRepository): Response
    {
        $productList = $productRepository->findBy(['recordState' => '0']);
        $categoryList = $categoryRepository->findBy(['recordState' => '0']);
        return $this->render('zay-pages/shop.html.twig',
            ['categoryLists' => $categoryList,'productLists' => $productList
        ]);
    }
    #[Route(path: '/product-cart', name: 'product_cart')]
    public function product_cart(): Response
    {
        return $this->render('zay-pages/product_cart.html.twig');
    }
    #[Route(path: '/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('zay-pages/login.html.twig');
    }
    #[Route(path: '/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('zay-pages/register.html.twig');
    }
    #[Route(path: '/forget-password', name: 'forget_password')]
    public function forget_password(): Response
    {
        return $this->render('zay-pages/forget_password.html.twig');
    }
    #[Route(path: '/account', name: 'account')]
    public function account(): Response
    {
        return $this->render('profile/account.html.twig');
    }
    #[Route(path: '/wishlist', name: 'wishlist')]
    public function wishlist(): Response
    {
        return $this->render('profile/wishlist.html.twig');
    }
    #[Route(path: '/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('admin/admin.html.twig');
    }
}
