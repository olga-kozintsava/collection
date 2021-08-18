<?php

declare(strict_types=1);

namespace App\Service\Category;


use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryDelete
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private CategoryRepository     $categoryRepository)
    {
    }

    /**
     * @param $id
     * @return Response
     */
    public function delete($id): Response
    {
       $category = $this->categoryRepository->findOneById($id);
       if (!is_null($category)){
           new JsonResponse(['status' => 'error']);
       }
       $this->entityManager->remove($category);
        $this->entityManager->flush();
       return new JsonResponse(['status' => 'ok']);
    }
}