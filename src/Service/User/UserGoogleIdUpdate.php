<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserGoogleIdUpdate
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param User $user
     * @param string $googleId
     * @return User
     */
public function update(User $user,string $googleId):User
{
    $user->setGoogleClientId($googleId);
    $this->entityManager->persist($user);
    $this->entityManager->flush();
    return $user;
}
}