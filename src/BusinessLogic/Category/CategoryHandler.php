<?php

declare(strict_types=1);

namespace App\BusinessLogic\Category;

use App\BusinessLogic\Validator;
use App\Entity\Category;
use App\Entity\User;
use App\Service\Category\CategoryCreator;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class CategoryHandler
{
    public function __construct(private Validator              $validator,
                                private EntityManagerInterface $entityManager,
                                private CategoryCreator        $categoryCreator)
    {
    }

    /**
     * @param  $data
     * @param User $user
     * @return Category
     * @throws Exception
     */

    public function handle($data,User $user): Category
    {
        $this->validator->validate($data);
        $category = $this->categoryCreator->create($data, $user);
        $this->entityManager->persist($category);
        $this->entityManager->flush();
        return $category;

    }
}