<?php

declare(strict_types=1);

namespace App\Service\like;

use App\Entity\Item;
use App\Entity\User;
use App\Repository\ItemRepository;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;

class LikeCount
{
    public function __construct(private LikeRepository $likeRepository)
    {
    }

    /**
     *
     * @param Item $item
     * @return int
     */

    public function count(Item $item)
    {
        return $this->likeRepository->findLikeCount($item);
    }
}