<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
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
    #[Route(path: '/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('admin/admin.html.twig');
    }
}
