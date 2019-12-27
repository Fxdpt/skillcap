<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category/new", name="admin_category_new")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_list');
        }

        return $this->render('admin/category/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/category/{id}/edit", name="admin_category_edit", requirements={"id":"\d+"})
     */
    public function edit(Category $category,EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_list');

        }

        return $this->render('admin/category/form.html.twig',[
            'form' => $form->createView(),
            'category' => $category
        ]);
    }

    /**
     * @Route("/admin/category/{id}/delete", name="admin_category_delete", requirements={"id":"\d+"}, methods={"POST"})
     */
    public function delete(Category $category, EntityManagerInterface $em){

        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('category_list');

    }
}
