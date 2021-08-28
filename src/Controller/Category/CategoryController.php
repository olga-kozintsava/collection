<?php

declare(strict_types=1);

namespace App\Controller\Category;

use App\Entity\Category;
use App\Form\Type\Category\AddCategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use App\Service\Category\CategoryCreator;
use App\Service\Category\CategoryDelete;
use App\Service\CustomField\FieldCreator;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoryController extends AbstractController
{

    /**
     * @Route("/category/add", name="category_new", methods={"GET", "POST"})
     * @param Request $request
     * @param CategoryCreator $categoryCreator
     * @param FieldCreator $fieldCreator
     * @return Response
     */
    public function add(Request $request, CategoryCreator $categoryCreator, FieldCreator $fieldCreator): Response
    {
        $category = new Category();
        $user = $this->getUser();
        $form = $this->createForm(AddCategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $category = $categoryCreator->create($form, $user);
////            $fieldCreator->create($form, $category);
                    return $this->redirectToRoute('category_list', ['userId' => $this->getUser()->getId()]);
        }
        return $this->renderForm('category/add.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/category/list/{userId}", name="category_list", methods={"GET"})
     * @param int $userId
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function showList(int $userId, CategoryRepository $categoryRepository): Response
    {
        // $id = $this->getUser()->getId();
        $category = $categoryRepository
            ->findByUserId($userId);

        return $this->render('category/list.html.twig', [
            'categoryList' => $category,
            'userId' => $userId
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show", methods={"GET"})
     * @param int $id
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function show(int $id, CategoryRepository $categoryRepository, ItemRepository $itemRepository): Response
    {
        $category = $categoryRepository->findOneById($id);
        $items = $itemRepository->findByCategory($category);

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'items' => $items
        ]);
    }

    /**
     * @Route("/category/{id}/delete", name="category_delete")
     * @param int $id
     * @param CategoryDelete $categoryDelete
     * @return Response
     */
    public function delete(int $id, CategoryDelete $categoryDelete): Response
    {
        $categoryDelete->delete($id);
        return $this->redirectToRoute('category_list', ['userId' => $this->getUser()->getId()]);
    }

    /**
     * @Route("/category/{id}/edit", name="category_edit", methods={"GET", "POST"})
     * @param Request $request
     * @param int $id
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function edit(Request $request, int $id, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneById($id);
        $form = $this->createForm(AddCategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('category_list', ['userId' => $this->getUser()->getId()]);
        }

        return $this->renderForm('category/edit.html.twig', [
            'form' => $form,
        ]);
    }
}