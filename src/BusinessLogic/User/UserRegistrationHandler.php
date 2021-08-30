<?php

declare(strict_types=1);

namespace App\BusinessLogic\User;

use App\BusinessLogic\Validator;
use App\DTO\User\UserRegistrationData;
use App\Entity\User;

use App\Service\User\UserCreator;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserRegistrationHandler
{
    public function __construct(private UserCreator            $userCreator,
                                private EntityManagerInterface $entityManager,
                                private Validator              $validator)
    {
    }

    /**
     * @param UserRegistrationData $data
     * @return User
     * @throws Exception
     */

    public function handle(UserRegistrationData $data): User
    {
        $this->validator->validate($data);
        $user = $this->userCreator->create($data);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;

    }
}