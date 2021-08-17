<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class CategoryCreator
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     *
     * @param $form
     * @param $user
     * @return Category
     */

    public function create($form, $user): Category
    {
        $category = $form->getData();
        $category->setDate();
        $category->setUser($user);
        $this->entityManager->persist($category);
        $this->entityManager->flush();
        return $category;
    }
}