<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class GoogleConfirm extends AbstractController
{
    /**
     * @Route("/googlee4b83ab533e20c57.html")
     */
    public function index(): Response
    {
        return $this->render('googlee4b83ab533e20c57.html');

    }
}