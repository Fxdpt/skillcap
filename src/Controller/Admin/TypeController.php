<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/admin/type/new", name="admin_type_new")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $type = new Type();

        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('type_show',[
                'id' => $type->getId(),
            ]);
        }

        return $this->render('admin/type/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/type/{id}/edit", name="admin_type_edit", requirements={"id":"\d+"})
     */
    public function edit(Type $type,EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($type);
            $em->flush();

            return $this->redirectToRoute('type_show',[
                'id' => $type->getId(),
            ]);

        }

        return $this->render('admin/type/form.html.twig',[
            'form' => $form->createView(),
            'type' => $type
        ]);
    }

    /**
     * @Route("/admin/type/{id}/delete", name="admin_type_delete", requirements={"id":"\d+"}, methods={"POST"})
     */
    public function delete(type $type, EntityManagerInterface $em){

        $em->remove($type);
        $em->flush();

        return $this->redirectToRoute('type_list');

    }
}
