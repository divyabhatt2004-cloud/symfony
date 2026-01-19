<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route(path:'/', name: 'index')]
    public function index(): Response
    {
      return $this->render('index.html.twig');
    }

    #[Route(path:'/form', name: 'form_submit', methods: ['GET'])]
    public function task_form(): Response
    {
      return $this->render('form.html.twig');
    }
}
