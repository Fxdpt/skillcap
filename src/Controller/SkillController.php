<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Repository\SkillRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillController extends AbstractController
{
    /**
     * @Route("/", name="skill_list")
     */
    public function list(SkillRepository $skillRepository)
    {
        return $this->render('skill/list.html.twig', [
            'skills' => $skillRepository->getAllSkillsWithData(),
        ]);
    }

    /**
     * @Route("/skill/{id}", name="skill_show", requirements={"id":"\d+"})
     */
    public function show(SkillRepository $skillRepository, $id)
    {
        return $this->render('skill/show.html.twig', [
            'skill' => $skillRepository->getOneSkillWithData($id),
        ]);
    }
}
