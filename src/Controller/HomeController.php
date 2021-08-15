<?php

declare(strict_types=1);

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
/**
 * @Route("/", name="home")
 */
public function index(AuthenticationUtils $authenticationUtils): \Symfony\Component\HttpFoundation\Response
{
    $lastUser = $authenticationUtils->getLastUsername();
    return $this->render('main.html.twig',
        ['last_user' =>$lastUser]
    );
}

}