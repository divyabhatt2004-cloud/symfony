<?php

namespace App\Controller;
use App\Entity\UserContact;
use App\Form\UserContactType;
use App\Repository\UserContactRepository;
use App\Service\StaticHelper;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
class ContactController extends AbstractController
{
    #[Route(path: '/support-admin', name: 'support_admin')]
    public function support_admin(Request $request, PaginatorInterface $paginator,UserContactRepository $UserSupportRepository): Response
    {
        $filters = StaticHelper::filters($request);

        $query = $UserSupportRepository->getUserRequests($filters);

        $userSupportLists = $paginator->paginate($query, $request->query->getInt('page',1),10);

        $params = [
            'status'=>true,
            'userSupportLists' => $userSupportLists,
            'query' => $userSupportLists,
            'pagination' => $userSupportLists,
            'recordsPerPage' => $filters['recordsPerPage'],
        ];

        if($request->isXmlHttpRequest()) {
            return $this->render('tables/request_table.html.twig',$params);
        }

        return $this->render('admin/support_admin.html.twig',$params);
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

            if($request->isXmlHttpRequest()) {
                return $this->json(['status' => true, 'msg' => 'Request added', 'redirect' => $this->generateUrl('support_admin')]);
            }
            return $this->redirectToRoute('contact');
        }
         $params =[
             'form' => $form->createView(),
         ];
        if($request->isXmlHttpRequest()) {
            return $this->render('formLayout/contact_form.html.twig',$params );
        }
        return $this->render('contact.html.twig', $params);
    }
    #[Route(path: '/edit-user-request/{id}', name: 'edit_user_request')]
    public function edit_user_request(Request $request,UserContactRepository $editUserRepository, EntityManagerInterface $em, string $id): Response
    {
        $user = $editUserRepository->find(['id' => $id]);
        $form = $this->createForm(UserContactType::class, $user, [
            'id' => $id, // Pass the condition as a form option
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('support_admin');
        }
        $params =[
            'form' => $form->createView(),
        ];
        if($request->isXmlHttpRequest()) {
            return $this->render('formLayout/contact_form.html.twig',$params );
        }
        return $this->render('admin/request_update.html.twig',$params );
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
