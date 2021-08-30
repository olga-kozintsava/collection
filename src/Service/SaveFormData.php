<?php

declare(strict_types=1);

namespace App\Service;

use App\BusinessLogic\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\FormInterface;

class SaveFormData
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private Validator              $validator)
    {
    }

    /**
     * @param FormInterface $form
     * @throws Exception
     */
    public function save(FormInterface $form): void
    {
        $data = $form->getData();
        $this->validator->validate($data);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}