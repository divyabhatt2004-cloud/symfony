<?php

namespace App\Controller;

use App\Entity\Todolist;
use App\Form\TodoListType;
use App\Repository\TodolistRepository;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TodoListController extends AbstractController
{
    #[Route(path: '/todo-lists', name: 'todo_lists')]
    public function todoLists(): Response
    {
        return $this->render('/todo_list/page.html.twig');
    }

    #[Route(path: '/todo-list-table', name: 'todo_list_table')]
    public function todoListTable(Request $request, TodolistRepository $todolistRepository): Response
    {
        $todoLists = $todolistRepository->getTodoLists();

        return $this->render('/todo_list/table.html.twig', [
            'todoLists' => $todoLists,
        ]);
    }

    #[Route(path: '/create-todo-lists', name: 'create_todo_list')]
    public function createTodoLists(Request $request, EntityManagerInterface $em): Response
    {
        $todoList = new TodoList();
        $form = $this->createForm(TodoListType::class, $todoList);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($todoList);
            $em->flush();
        }
        return $this->render('/todo_list/form.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/edit-todo-lists/{todoListId}', name: 'edit_todo_list')]
    public function editTodoLists(Request $request, TodolistRepository $todolistRepository, EntityManagerInterface $em, string $todoListId): Response
    {
        $todoList = $todolistRepository->getTodoListById($todoListId);
        if (!$todoList) {
            throw new RuntimeException('Todo list not found');
        }
        $form = $this->createForm(TodoListType::class, $todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($todoList);
            $em->flush();
        }

        return $this->render('/todo_list/form.html.twig');
    }

    #[Route(path: '/delete-todo-lists/{todoListId}', name: 'delete_todo_list')]
    public function deleteTodoLists(TodolistRepository $todolistRepository, EntityManagerInterface $em, string $todoListId): Response
    {
        $todoList = $todolistRepository->getTodoListById($todoListId);
        if (!$todoList) {
            throw new RuntimeException('Todo list not found');
        }
        $todoList->setRecordState(1);
        $em->persist($todoList);
        $em->flush();

        return $this->json(['success' => true]);
    }
}
