<?php

declare(strict_types=1);

namespace App\Controller\Item;

use App\Entity\Category;
use App\Entity\Item;
use App\Entity\Tag;
use App\Form\Type\Category\AddCategoryType;
use App\Form\Type\Item\ItemType;
use App\Service\Category\CategoryCreator;
use App\Service\Item\ItemCreator;
use App\Service\Item\ItemDelete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{

    /**
     * @Route("/{id}/item/add", name="item_add", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param int $id
     * @param ItemCreator $itemCreator
     * @return Response
     */
    public function add(Request $request,int $id, ItemCreator $itemCreator): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $itemCreator->create($form, $id);
          return $this->redirectToRoute('category_show', ['id'=>$id]);
        }
        return $this->renderForm('item/add.html.twig', [
            'form' => $form
        ]);
    }
    /**
     * @Route("{category_id}/item/delete/{id}", name="item_delete")
     * @param int $category_id
     * @param int $id
     * @param ItemDelete $itemDelete
     * @return Response
     */
    public function delete(int $category_id, int $id, ItemDelete $itemDelete): Response
    {
        $itemDelete->delete($id);
        return $this->redirectToRoute('category_show', ['id'=>$category_id]);
    }

}