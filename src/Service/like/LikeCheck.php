<?php

declare(strict_types=1);

namespace App\Service\like;

use App\Entity\Like;
use App\Entity\User;
use App\Repository\ItemRepository;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;

class LikeCheck
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private LikeRepository         $likeRepository,
                                private ItemRepository         $itemRepository,
                                private LikeCreator            $likeCreator)
    {
    }

    /**
     *
     * @param User $user
     * @param int $item_id
     * @return bool
     */

    public function check(User $user, int $item_id): bool
    {
        $item = $this->itemRepository->findOneById($item_id);
        $like = $this->likeRepository->findByUserAndItem($user, $item);
        if ($like) {
            return $this->checkLike($like);
        } else {
            $this->likeCreator->create($user, $item);
            return true;
        }
    }

    /**
     *
     * @param Like $like
     * @return bool
     */
    private function checkLike(Like $like): bool
    {
        if ($like->getIsLike()) {
            $like->setIsLike(false);
            $this->entityManager->flush();
            return false;
        } else {
            $like->setIsLike(true);
            $this->entityManager->flush();
            return true;
        }
    }
}