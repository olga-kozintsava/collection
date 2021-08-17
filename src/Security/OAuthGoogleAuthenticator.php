<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\User;

// your user entity
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class OAuthGoogleAuthenticator extends OAuth2Authenticator
{
    private $clientRegistry;
    private $entityManager;
    private $router;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $entityManager, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }


    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'google_auth';
    }

    public function authenticate(Request $request): PassportInterface
    {
        $client = $this->clientRegistry->getClient('google');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(new UserBadge((string)$accessToken));
//            new UserBadge((string)$accessToken, function () use ($accessToken, $client) {
//
//                $googleUser = $client->fetchUserFromToken($accessToken);
//
//                $email = $googleUser->getEmail();
//
//                // 1) have they logged in with Facebook before? Easy!
//                $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['googleClientId' => $googleUser->getId()]);
//
//                if ($existingUser) {
//                    return $existingUser;
//                }
//
//                // 2) do we have a matching user by email?
//                $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
//                if (!$user) {
//                    $user = new User();
//                    $user->setGoogleClientId($googleUser->getId());
//                    $user->setEmail($email);
//                    $user->setName($googleUser->getName());
//                    $user->setPassword($googleUser->getPassword());
//                    $this->entityManager->persist($user);
//                    $this->entityManager->flush();
//                }
//                return $user;
//            })
//        );
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // change "app_homepage" to some route in your app
        $targetUrl = $this->router->generate('home');

        return new RedirectResponse($targetUrl);

        // or, on success, let the request continue to be handled by the controller
        //return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }
}






