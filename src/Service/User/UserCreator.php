<?php

declare(strict_types=1);

namespace App\Service\User;

use App\DTO\User\UserRegistrationData;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserCreator
{
private PasswordHasherInterface $passwordHasher;
public function __construct(PasswordHasherFactoryInterface $hasherFactory)
{
    $this->passwordHasher = $hasherFactory->getPasswordHasher(User::class);
}

    public function create(UserRegistrationData $data): User
    {
        $encodedPassword = $this->passwordHasher->hash($data->password);
//        return new User($data->name, $data->email, $encodedPassword);
        $user = new User();
        $user->setName($data->name);
        $user->setEmail($data->email);
        $user->setPassword($encodedPassword);
        return $user;
    }
}










