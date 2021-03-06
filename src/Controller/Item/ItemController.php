<?php

declare(strict_types=1);

namespace App\Controller\Item;

use App\BusinessLogic\Item\ItemHandler;
use App\Entity\Item;
use App\Repository\CommentRepository;
use App\Repository\ItemRepository;
use App\Service\Item\ItemCreate;
use App\Service\Item\ItemCustomFieldCreate;
use App\Service\Item\ItemCustomFieldUpdate;
use App\Service\Item\ItemDelete;
use App\Service\Item\ItemFormCreate;
use App\Service\like\LikeCount;
use App\Service\SaveFormData;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ItemController extends AbstractController
{
    public function __construct(
        private ItemRepository        $itemRepository,
        private ItemFormCreate        $itemFormCreate,
        private ItemDelete            $itemDelete,
        private CommentRepository     $commentRepository,
        private LikeCount             $likeCount,
        private ItemHandler           $handler,
        private SaveFormData          $saveFormData,
        private ItemCustomFieldUpdate $customFieldUpdate)
    {
    }

    /**
     * @Route("/{id}/item/add", name="item_add", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function add(Request $request, int $id): Response
    {
        $item = new Item();
        $form = $this->itemFormCreate->create($id, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handler->handle($form, $id);
            return $this->redirectToRoute('category_show', ['id' => $id]);
        }
        return $this->renderForm('item/add.html.twig', [
            'form' => $form,
            'button_text' => 'Add'
        ]);
    }


    /**
     * @Route("{category_id}/item/edit/{id}", name="item_edit")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param int $category_id
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function edit(Request $request, int $category_id, int $id): Response
    {
        $item = $this->itemRepository->findOneById($id);
        $form = $this->itemFormCreate->create($category_id, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveFormData->save($form);
            $this->customFieldUpdate->update($form, $id);
            return $this->redirectToRoute('category_show', ['id' => $category_id]);
        }
        return $this->renderForm('item/add.html.twig', [
            'form' => $form,
            'button_text' => 'Update'
        ]);
    }

    /**
     * @Route("/item/{id}", name="item_show", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public
    function show(int $id): Response
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
     * @IsGranted("ROLE_USER")
     * @param int $category_id
     * @param int $id
     * @return Response
     */
    public
    function delete(int $category_id, int $id): Response
    {
        $this->itemDelete->delete($id);
        return $this->redirectToRoute('category_show', ['id' => $category_id]);
    }

}