<?php

declare(strict_types=1);

namespace App\Service\Item;

use App\Entity\Item;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class ItemCreator
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private CategoryRepository $categoryRepository)
    {
    }

    /**
     *
     * @param $form
     * @param $id
     * @return Item
     */

    public function create($form, $id): Item
    {
        $item = $form->getData();
        $item->setDate();
        $category = $this->categoryRepository->findOneById($id);
        $item->setCategory($category);
        $this->entityManager->persist($item);
        $this->entityManager->flush();
        return $item;
    }
}