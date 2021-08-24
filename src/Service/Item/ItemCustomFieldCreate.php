<?php

declare(strict_types=1);

namespace App\Service\Item;

use App\Entity\Item;
use App\Entity\ItemCustomField;
use App\Repository\CategoryRepository;
use App\Repository\CustomFieldRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class ItemCustomFieldCreate
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private CustomFieldRepository  $customFieldRepository)
    {
    }

    /**
     *
     * @param Form $form
     * @param int $id
     * @param Item $item
     *
     */
    public function create(Form $form, int $id, Item $item): void
    {
        $fields = $this->customFieldRepository->findByCategory($id);
        foreach ($fields as $value) {
            $itemCustomField = new ItemCustomField();
            $itemCustomField->setField($value->getTitle());
            $itemCustomField->setValue($form->get($value->getTitle())->getData());
            $itemCustomField->setItem($item);
            $this->entityManager->persist($itemCustomField);
            $this->entityManager->flush();
        }
    }
    }