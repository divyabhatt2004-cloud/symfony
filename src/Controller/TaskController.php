<?php
// src/Controller/TaskController.php
namespace App\Controller;

use App\Entity\TodoList;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// ...

class TaskController extends AbstractController
{
    public function user(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $task = new TodoList();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $task->setTitle($request->request->get('title'));
            $task->setDescription($request->request->get('description'));

            return $this->redirectToRoute('task_submitted');
        }
        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
