<?php

declare(strict_types=1);

namespace App\Controller\Category;

use App\Entity\Category;
use App\Entity\Item;
use App\Form\Type\Category\AddCategoryType;
use App\Form\Type\Item\ItemType;
use App\Service\Category\CategoryCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{

    /**
     * @Route("/item/add", name="item_add", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param CategoryCreator $categoryCreator
     * @return Response
     */
    public function add(Request $request, CategoryCreator $categoryCreator): Response
    {
        $category = new Item();
        $user =  $this->getUser();
        $form = $this->createForm(ItemType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            $categoryCreator->create($form, $user);
            return $this->redirectToRoute('category_show');
        }
        return $this->renderForm('item/add.html.twig', [
            'form' => $form,
        ]);
    }}