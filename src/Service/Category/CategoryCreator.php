<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class CategoryCreator
{
    /**
     * @param $data
     * @param User $user
     * @return Category
     */

    public function create($data, User $user): Category
    {
        $category = $data;
        $category->setDate();
        $category->setUser($user);
        return $category;
    }
}