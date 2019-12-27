<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{


    /**
     * @Route("/task/{id}", name="task_show", requirements={"id":"\d+"})
     */
    public function show(Task $task)
    {
        return $this->render('task/show.html.twig',[
            'task' => $task,
        ]);
    }
}
