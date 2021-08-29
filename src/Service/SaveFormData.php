<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class SaveFormData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }
     /**
      * @param FormInterface $form
       */
public function save(FormInterface $form): void
{
    $data = $form->getData();
    $this->entityManager->persist($data);
    $this->entityManager->flush();
}
}