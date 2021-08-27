<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserGithubCreate
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param $githubUser
     * @return User
     */
    public function create($githubUser): User
    {
        $user = new User();
        $user->setGithubClientId($githubUser->getId());
        $user->setName($githubUser->toArray()['login']);
        $user->setEmail("{$githubUser->getId()}@githuboauth.com");
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }
}