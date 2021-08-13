<?php

declare(strict_types=1);

namespace App\Controller\User;


use App\BusinessLogic\User\UserRegistrationHandler;
use App\DTO\User\UserRegistrationData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserRegistrationController
{

    /**
     * @Route("/signup", name="user_registration", methods={"POST"})
     *
     * @param Request $request
     * @param UserRegistrationHandler $handler
     * @return Response
     */
    public function registrationUser(Request $request, UserRegistrationHandler $handler): Response
    {
        $userRegistrationData = new UserRegistrationData();
        $userRegistrationData->name = $request->get('username');
        $userRegistrationData->email = $request->get('email');
        $userRegistrationData->password = $request->get('password');
        $user = $handler->handle($userRegistrationData);
        return new Response('test');
    }
}