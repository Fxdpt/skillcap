<?php

namespace App\Controller\Admin;

use App\Entity\Task;
use App\Entity\Skill;
use App\Form\TaskType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/task/{skill}", name="admin_task_")
 */
class TaskController extends AbstractController
{
    /**
     * @Route("/new", name="new")
     */
    public function new(Skill $skill, EntityManagerInterface $em, Request $request)
    {
        $task = new Task();
        $task->setSkill($skill);

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em->persist($task);
            $em->flush();
            
            $status= [];
            foreach ($skill->getTasks() as $skillTask) {
                $status[] = $skillTask->getStatus();
            };
            
            $totalStatus = count($status);
            $totalTrueStatus = count(array_filter($status));
            
            $percentOfTrue = $totalTrueStatus * 100 / $totalStatus;
            
            $skill->setStatusRange($percentOfTrue);
            
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('skill_show', [
                'id' => $skill->getId(),
            ]);
        }

        return $this->render('admin/task/form.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", requirements={"id":"\d+"})
     */
    public function edit(Skill $skill, Task $task, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('skill_show', [
                'id' => $skill->getId(),
            ]);
        }

        return $this->render('admin/task/form.html.twig', [
            'form' => $form->createView(),
            'skill' => $skill,
            'task' => $task
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", requirements={"id":"\d+"}, methods={"POST"})
     */
    public function delete(Skill $skill, Task $task, EntityManagerInterface $em)
    {

        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('skill_show', [
            'id' => $skill->getId(),
        ]);
    }

    /**
     * @Route("/{id}/switchstatus", name="switch_status", requirements={"id":"\d+"}, methods={"POST"})
     */
    public function switchStatus(Skill $skill, Task $task, EntityManagerInterface $em, SkillRepository $skillRepository)
    {
        
        if ($task->getStatus()) {
            $task->setStatus(false);
        } else {
            $task->setStatus(true);
        }

        $status= [];
        foreach ($skill->getTasks() as $skillTask) {
            $status[] = $skillTask->getStatus();
        };
        
        
        $totalStatus = count($status);
        $totalTrueStatus = count(array_filter($status));
        
        $percentOfTrue = $totalTrueStatus * 100 / $totalStatus;
        
        $skill->setStatusRange($percentOfTrue);
        
        $em->persist($skill);
        $em->persist($task);
        $em->flush();

        return $this->redirectToRoute('skill_show', [
            'id' => $task->getSkill()->getId(),
        ]);
    }
}
