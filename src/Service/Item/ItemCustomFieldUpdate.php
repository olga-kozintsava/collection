<?php

declare(strict_types=1);

namespace App\Service\Item;

use App\Entity\Item;
use App\Entity\ItemCustomField;
use App\Repository\CustomFieldRepository;
use App\Repository\ItemCustomFieldRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class ItemCustomFieldUpdate
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private ItemCustomFieldRepository $itemCustomFieldRepository)
    {
    }

    /**
     *
     * @param Form $form
     * @param int $id
     */
    public function update(Form $form, int $id): void
    {
        $fields = $this->itemCustomFieldRepository->findByItemId($id);
        foreach ($fields as $value) {
            $value->setValue($form->get($value->getTitle())->getData());
            $this->entityManager->persist($value);
            $this->entityManager->flush();
        }
    }
}