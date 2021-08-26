<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;

class GetGoogleUser
{
    public function __construct(private UserRepository     $userRepository,
                                private UserGoogleIdUpdate $googleIdUpdate,
                                private UserGoogleCreate   $authCreate)
    {
    }

    /**
     * @param $accessToken
     * @param $client
     * @return User
     */
    public function getUser($accessToken, $client): User
    {
        $googleUser = $client->fetchUserFromToken($accessToken);
        $existingUser = $this->userRepository->findOneByGoogleClientId($googleUser->getId());
        if ($existingUser) {
            return $existingUser;
        }
        $user = $this->userRepository->findOneByEmail($googleUser->getEmail());
        if ($user) {
            return $this->googleIdUpdate->update($user, $googleUser->getId());
        } else {
            return $this->authCreate->create($googleUser);
        }


    }
}