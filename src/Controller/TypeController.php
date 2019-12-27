<?php

namespace App\Controller;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type_list")
     */
    public function list(TypeRepository $typeRepository)
    {
        return $this->render('type/list.html.twig', [
            'types' => $typeRepository->getAllTypesWithData(),
        ]);
    }

    /**
     * @Route("/type/{id}", name="type_show", requirements={"id":"\d+"})
     */
    public function show(TypeRepository $typeRepository, $id)
    {
        return $this->render('type/show.html.twig', [
            'type' => $typeRepository->getOneTypeWithData($id),
        ]);
    }
}
