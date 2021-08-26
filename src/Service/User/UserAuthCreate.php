<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserAuthCreate
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param $googleUser
     * @return User
     */
    public function create($googleUser):User
    {
        $user = new User();
        $user->setGoogleClientId($googleUser->getId());
        $user->setEmail($googleUser->getEmail());
        $user->setName($googleUser->getName());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }
}