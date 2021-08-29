<?php

declare(strict_types=1);

namespace App\Service\Item;

use App\Entity\Item;
use App\Form\Type\Item\ItemType;
use App\Repository\CustomFieldRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;


class ItemFormCreate extends AbstractController
{
    public function __construct(private CustomFieldRepository $customFieldRepository)
    {
    }

    /**
     *
     * @param int $id
     * @param Item $item
     * @return FormInterface
     */
    public function create(int $id, Item $item):FormInterface
    {
        $fields = $this->customFieldRepository->findByCategory($id);
        return $this->createForm(ItemType::class, $item, ['fields'=> $fields ]);

    }
}