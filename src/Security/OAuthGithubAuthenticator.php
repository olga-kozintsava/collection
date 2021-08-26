<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\User\GetGoogleUser;
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

class OAuthGithubAuthenticator extends OAuth2Authenticator
{
    public function __construct(private ClientRegistry  $clientRegistry,
                                private RouterInterface $router,
                                )
    {
    }

    /**
     * @param Request $request
     * @return bool|null
     */
    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'connect_github_check';
    }

    /**
     * @param Request $request
     * @return PassportInterface
     */
    public function authenticate(Request $request): PassportInterface
    {
        $client = $this->clientRegistry->getClient('github:');
        $accessToken = $this->fetchAccessToken($client);
        return new SelfValidatingPassport(
            new UserBadge((string)$accessToken,
                function () use ($accessToken, $client) {
//                    return $this->getGoogleUser->getUser($accessToken, $client);
                    $githubUser = $client->fetchUserFromToken($accessToken);
                    $email = $githubUser->getEmail();
                    var_dump($githubUser);
//                    $existingUser = $this->userRepository->findOneByGithubClientId($githubUser->getId());
//                    if ($existingUser) {
//                        return $existingUser;
//                    }
//                    $user = $this->userRepository->findOneByEmail($email);
//                    if ($user) {
//                        $user->setGoogleClientId($githubUser->getId());
//
//
//                    } else {
//                        $user = new User();
//                        $user->setGithubClientId($githubUser->getId());
//                        $user->setEmail($email);
//                        $user->setName($githubUser->getName());
//                    }
//                    $this->entityManager->persist($user);
//                    $this->entityManager->flush();
//                    return $user;
                }),
        );
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return RedirectResponse
     */
    public
    function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): RedirectResponse
    {

        $targetUrl = $this->router->generate('main');
        return new RedirectResponse($targetUrl);
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response|null
     */
    public
    function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());
        return new Response($message, Response::HTTP_FORBIDDEN);
    }
}
