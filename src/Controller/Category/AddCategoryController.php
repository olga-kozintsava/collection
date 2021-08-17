<?php

declare(strict_types=1);

namespace App\Controller\Category;


use App\BusinessLogic\User\UserRegistrationHandler;
use App\Entity\Category;
use App\Form\Type\Collection\AddCategoryType;
use App\Form\Type\User\UserRegistrationType;
use App\Service\Category\CategoryCreator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddCategoryController extends AbstractController
{

    /**
     * @Route("/add_category", name="add_category", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param CategoryCreator $categoryCreator
     * @return Response
     */
    public function addCategory(Request $request, CategoryCreator $categoryCreator): Response
    {
        $category = new Category();
        $user =  $this->getUser();
        $form = $this->createForm(AddCategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categoryCreator->create($form, $user);
        }
        return $this->renderForm('category/edit.html.twig', [
            'form' => $form,
        ]);
    }
}