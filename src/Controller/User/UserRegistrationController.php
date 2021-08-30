<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\BusinessLogic\User\UserRegistrationHandler;
use App\DTO\User\UserRegistrationData;
use App\Form\Type\User\UserRegistrationType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserRegistrationController extends AbstractController
{
    public function __construct(private UserRegistrationHandler $handler)
    {
    }

    /**
     * @Route("/signup", name="user_registration", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function registrationUser(Request $request): Response
    {
        $form = $this->createForm(UserRegistrationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handler->handle($form->getData());
            return $this->redirectToRoute('form_login');
        }
        return $this->render('user/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}