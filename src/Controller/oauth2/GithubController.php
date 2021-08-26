<?php

declare(strict_types=1);

namespace App\Controller\oauth2;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GithubController extends AbstractController
{
    /**
     * @Route("/connect/github", name="connect_github_start")
     * @param ClientRegistry $clientRegistr
     * @return RedirectResponse
     */
    public function connectGithubAction(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry
            ->getClient('github')
            ->redirect([
                'user:email'
            ]);
    }

    /**
     * @Route("/connect/github/check", name="connect_github_check")
     */
    public function connectGithubCheckAction()
    {
 //       if (!$this->getUser()) {
//            return new JsonResponse(['status' => false, 'message' => "User not found!"]);
//        } else {
//            return $this->redirectToRoute('form_login');
//        }
    }

}