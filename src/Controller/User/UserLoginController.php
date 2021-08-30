<?php

declare(strict_types=1);

namespace App\Controller\User;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class UserLoginController extends AbstractController
{
    public function __construct(private AuthenticationUtils $authenticationUtils)
    {
    }

    /**
     * @Route("/login", name="form_login", methods={"POST", "GET"})
     * @return Response
     */
    public function formLoginAction(): Response
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils->getLastUsername();
        return $this->render('user/form_login.html.twig',
            ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     * @throws Exception
     */
    public function logout(): void
    {
        throw new Exception('Will be intercepted before getting here');
    }
}