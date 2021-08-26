<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;

class GetGithubUser
{
    public function __construct(private UserRepository     $userRepository,
                                private UserGithubCreate $githubCreate)
    {
    }

    /**
     * @param $accessToken
     * @param $client
     * @return User
     */
    public function getUser($accessToken, $client): User
    {
        $githubUser = $client->fetchUserFromToken($accessToken);
        $existingUser = $this->userRepository->findOneByGoogleClientId($githubUser->getId());

        if ($existingUser) {
            return $existingUser;
        }else{
            return $this->githubCreate->create($githubUser);
        }




    }}
