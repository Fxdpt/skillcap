<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillController extends AbstractController
{
    /**
     * @Route("/admin/skill/new", name="admin_skill_new")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $skill = new Skill();

        $form = $this->createForm(SkillType::class, $skill);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('skill_show',[
                'id' => $skill->getId(),
            ]);
        }

        return $this->render('admin/skill/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/skill/{id}/edit", name="admin_skill_edit", requirements={"id":"\d+"})
     */
    public function edit(Skill $skill,EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(SkillType::class, $skill);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('skill_show',[
                'id' => $skill->getId(),
            ]);

        }

        return $this->render('admin/skill/form.html.twig',[
            'form' => $form->createView(),
            'skill' => $skill
        ]);
    }

    /**
     * @Route("/admin/skill/{id}/delete", name="admin_skill_delete", requirements={"id":"\d+"}, methods={"POST"})
     */
    public function delete(Skill $skill, EntityManagerInterface $em){

        $em->remove($skill);
        $em->flush();

        return $this->redirectToRoute('skill_list');

    }

}
