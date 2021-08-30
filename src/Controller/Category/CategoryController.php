<?php

declare(strict_types=1);

namespace App\Controller\Category;

use App\Service\SaveFormData;
use App\Entity\Category;
use App\Form\Type\Category\AddCategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use App\Service\Category\CategoryCreator;
use App\Service\Category\CategoryDelete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoryController extends AbstractController
{
    public function __construct(private SaveFormData       $saveFormData,
                                private CategoryCreator    $categoryCreator,
                                private CategoryRepository $categoryRepository,
                                private ItemRepository     $itemRepository,
                                private CategoryDelete     $categoryDelete)
    {
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/category/add", name="category_new", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function add(Request $request,): Response
    {
        $category = new Category();
        $user = $this->getUser();
        $form = $this->createForm(AddCategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryCreator->create($form, $user);
            return $this->redirectToRoute('category_list', ['userId' => $user->getId()]);
        }
        return $this->renderForm('category/form.html.twig', [
            'form' => $form,
            'button_text' => 'Add'
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/category/list/{userId}", name="category_list", methods={"GET"})
     * @param int $userId
     * @return Response
     */
    public function showList(int $userId): Response
    {
        $category = $this->categoryRepository
            ->findByUserId($userId);
        return $this->render('category/list.html.twig', [
            'categoryList' => $category,
            'userId' => $userId
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $category = $this->categoryRepository->findOneById($id);
        $items = $this->itemRepository->findByCategory($category);
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'items' => $items
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/category/{id}/delete", name="category_delete")
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $this->categoryDelete->delete($id);
        return $this->redirectToRoute('category_list', ['userId' => $this->getUser()->getId()]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/category/{id}/edit", name="category_edit", methods={"GET", "POST"})
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, int $id): Response
    {
        $category = $this->categoryRepository->findOneById($id);
        $form = $this->createForm(AddCategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveFormData->save($form);
            return $this->redirectToRoute('category_list', ['userId' => $this->getUser()->getId()]);
        }
        return $this->renderForm('category/form.html.twig', [
            'form' => $form,
            'button_text' => 'Update'
        ]);
    }
}