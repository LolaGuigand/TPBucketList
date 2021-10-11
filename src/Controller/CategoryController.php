<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\WishFormType;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    public function add(Request $request):Reponse{
        $categ = new Category();
        $form=$this->createForm(WishFormType::class,
        categ);
    }
}
