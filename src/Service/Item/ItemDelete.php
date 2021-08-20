<?php

declare(strict_types=1);

namespace App\Service\Item;

use App\Entity\Item;
use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemDelete
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private ItemRepository     $itemRepository)
    {
    }

    /**
     * @param $id
     * @return Response
     */
    public function delete($id): Response
    {
        $item = $this->itemRepository->findOneById($id);
        if (!is_null($item)){
            new JsonResponse(['status' => 'error']);
        }
        $this->entityManager->remove($item);
        $this->entityManager->flush();
        return new JsonResponse(['status' => 'ok']);
    }
}