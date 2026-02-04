<?php

namespace App\Controller;
use App\Entity\zayEntity\UserContact;
use App\Form\UserContactForm;
use App\Repository\UserContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
class ContactController extends AbstractController
{
    #[Route(path: '/support-admin', name: 'support_admin')]
    public function support_admin(UserContactRepository $UserSupportRepository): Response
    {
        $userSupportList = $UserSupportRepository->findBy(['recordState' => '0']);
        return $this->render('admin/support_admin.html.twig', [
            'userSupportLists' => $userSupportList,
        ]);
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
        return $this->render('zay-pages/contact.html.twig', [
            'form' => $form->createView(),
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
        return $this->render('zay-pages/contact.html.twig', [
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

}
