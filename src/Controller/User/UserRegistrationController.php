<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\BusinessLogic\User\UserRegistrationHandler;
use App\DTO\User\UserRegistrationData;
use App\Form\Type\User\UserRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserRegistrationController extends AbstractController
{

    /**
     * @Route("/signup", name="user_registration", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param UserRegistrationHandler $handler
     * @return Response
     */
    public function registrationUser(Request $request, UserRegistrationHandler $handler): Response
    {
        $form = $this->createForm(UserRegistrationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $handler->handle($form->getData());
        return $this->redirectToRoute('form_login');
        }
        return $this->render('user/signup.html.twig', [
            'form'=> $form->createView(),
    ]);
        }
//        $userRegistrationData = new UserRegistrationData();
//        $userRegistrationData->name = $request->get('username');
//        $userRegistrationData->email = $request->get('email');
//        $userRegistrationData->password = $request->get('password');
//        $user = $handler->handle($userRegistrationData);
//        return new Response('test');

}