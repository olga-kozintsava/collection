<?php

namespace App\BusinessLogic\User;


use App\DTO\User\UserRegistrationData;
use App\Entity\User;
use App\Service\User\UserCreator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserRegistrationHandler
{
    public function __construct(private ValidatorInterface     $validator,
                                private UserCreator            $userCreator,
                                private EntityManagerInterface $entityManager)
    {

    }

    /**
     * @param UserRegistrationData $ data
     *
     * @return User
     *
     * @throws ValidatorException
     */

    public function handle(UserRegistrationData $data): User
    {
//        $userEmail = $this->entityManager->getRepository(User::class)->findBy(['email'=>$data->email]);
//        if ($userEmail ){
//            throw new \Exception();
//        }

        $violationList = $this->validator->validate($data);
        if ($violationList->count() > 0) {
//        throw ValidatorException::fromViolationList($violationList);
            throw new \Exception((string)$violationList);
        }
        $user = $this->userCreator->create($data);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;

    }
}