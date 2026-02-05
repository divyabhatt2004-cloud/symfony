<?php

namespace App\Controller;
use App\Entity\UserContact;
use App\Form\UserContactType;
use App\Repository\UserContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
class ContactController extends AbstractController
{
    #[Route(path: '/support-admin', name: 'support_admin')]
    public function support_admin(): Response
    {
        return $this->render('admin/support_admin.html.twig');
    }
    #[Route(path: '/request-table', name: 'request_table')]
    public function productTable(UserContactRepository $UserSupportRepository): Response
    {
        $userSupportList = $UserSupportRepository->getUserRequests();

        return $this->render('tables/request_table.html.twig', [
            'userSupportLists' => $userSupportList,
        ]);
    }
    #[Route(path: '/contact', name: 'contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $user = new UserContact();
        $form = $this->createForm(UserContactType::class, $user);

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
    #[Route(path: '/edit-user-request/{id}', name: 'edit_user_request')]
    public function edit_user_request(Request $request,UserContactRepository $editUserRepository, EntityManagerInterface $em, string $id): Response
    {
        $user = $editUserRepository->find(['id' => $id]);
        $form = $this->createForm(UserContactType::class, $user, [
            'id' => $id, // Pass the condition as a form option
        ]);


//        $form = $this->createForm(YourFormType::class, $entity, [
//            'is_edit_mode' => $isEditMode, // Pass the condition as a form option
//        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('support_admin');
        }
        return $this->render('admin/request_update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route(path:'/delete-user-request/{id}', name: 'delete_user_request')]
    public function delete_user_request(UserContactRepository $deleteUserRepository,EntityManagerInterface $em,string $id): Response
    {
        $user = $deleteUserRepository->find(['id' => $id]);
        $user->setRecordState(1);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('support_admin');
    }

}
