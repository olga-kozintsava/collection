<?php

declare(strict_types=1);

namespace App\Service\Comment;

use App\Entity\Category;
use App\Entity\Comment;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;

class CommentCreator
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private ItemRepository         $itemRepository)
    {
    }

    /**
     *
     * @param $form
     * @param $user
     * @param $id
     * @return Comment
     */

    public function create($form, $user, $id): Comment
    {
        $comment = $form->getData();
        $comment->setDateCreate();
        $comment->setUser($user);
        $item = $this->itemRepository->findOneById($id);
        $comment->setItem($item);
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
        return $comment;
    }
}