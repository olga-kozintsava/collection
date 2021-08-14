<?php

declare(strict_types=1);

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
class UserLoginController extends AbstractController
{
    /**
     * @Route("/login", name="form_login", methods={"POST", "GET"})
     *
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function formLoginAction(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/form_login.html.twig',
            ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \Exception('Will be intercepted before getting here');
    }
}