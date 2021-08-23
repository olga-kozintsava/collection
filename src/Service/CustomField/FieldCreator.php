<?php

declare(strict_types=1);

namespace App\Service\CustomField;

use App\Entity\Category;
use App\Entity\CustomField;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class FieldCreator
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     *
     * @param Category $category
     * @param  $form
     * @return CustomField
     */

    public function create($form,Category $category): CustomField
    {
        $field =  $form->get('field')->getData();
        $field->setCategory($category->getId());
        $this->entityManager->persist($field);
        $this->entityManager->flush();
        return $field;
    }
}