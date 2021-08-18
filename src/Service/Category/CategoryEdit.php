<?php

declare(strict_types=1);

namespace App\Service\Category;

use Doctrine\ORM\EntityManagerInterface;

class CategoryEdit
{
public function edit(EntityManagerInterface $entityManager){
    $em = $entityManager->getDoctrine()->getManager();
    $em->flush();
}
}