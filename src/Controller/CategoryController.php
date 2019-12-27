<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_list")
     */
    public function list(CategoryRepository $categoryRepository)
    {
        return $this->render('category/list.html.twig', [
            'categories' => $categoryRepository->getAllCategoriesWithData(),
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show", requirements={"id":"\d+"})
     */
    public function show(CategoryRepository $categoryRepository, $id)
    {
        return $this->render('category/show.html.twig', [
            'category' => $categoryRepository->getOneCategoryWithData($id),
        ]);
    }
}
