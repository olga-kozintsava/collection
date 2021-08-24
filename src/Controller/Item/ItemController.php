<?php

declare(strict_types=1);

namespace App\Controller\Item;

use App\Entity\Category;
use App\Entity\Item;
use App\Entity\Tag;
use App\Form\Type\Item\ItemType;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\CustomFieldRepository;
use App\Repository\ItemRepository;
use App\Service\Item\ItemCreator;
use App\Service\Item\ItemDelete;
use App\Service\like\LikeCount;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    public function __construct(private CustomFieldRepository $customFieldRepository,
                                private CategoryRepository    $categoryRepository,
                                private ItemRepository        $itemRepository,
                                private ItemCreator           $itemCreator,
                                private ItemDelete            $itemDelete,
                                private CommentRepository     $commentRepository,
                                private LikeCount             $likeCount)
    {
    }

    /**
     * @Route("/{id}/item/add", name="item_add", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function add(Request $request, int $id): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->itemCreator->create($form, $id);
            $category = $this->categoryRepository->findOneById($id);

            $f = $this->customFieldRepository->findByCategory($id);
            var_dump($f);

//          return $this->redirectToRoute('category_show', ['id'=>$id]);
        }
        return $this->renderForm('item/add.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/item/{id}", name="item_show", methods={"GET"})
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {

        $item = $this->itemRepository->findOneById($id);
        $comments = $this->commentRepository->findByItem($item);
        $likeCount = $this->likeCount->count($item);
        return $this->render('item/show.html.twig', [
            'item' => $item,
            'comments' => $comments,
            'like' => $likeCount
        ]);
    }

    /**
     * @Route("{category_id}/item/delete/{id}", name="item_delete")
     *
     * @param int $category_id
     * @param int $id
     * @return Response
     */
    public function delete(int $category_id, int $id): Response
    {
        $this->itemDelete->delete($id);
        return $this->redirectToRoute('category_show', ['id' => $category_id]);
    }

}