<?php

declare(strict_types=1);

namespace App\Service\like;

use App\Entity\Item;
use App\Entity\Like;
use App\Entity\User;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;

class LikeCreator
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private LikeRepository         $likeRepository)
    {
    }

    /**
     *
     * @param User $user
     * @param Item $item
     * @return Like
     */

    public function create(User $user, Item $item): Like
    {
        $like = new Like();
        $like->setUser($user);
        $like->setItem($item);
        $like->setIsLike(true);
        $this->entityManager->persist($like);
        $this->entityManager->flush();
        return $like;
    }
}