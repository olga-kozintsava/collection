<?php

declare(strict_types=1);

namespace App\Security;

use App\Service\User\GetGoogleUser;
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
    public function __construct(private ClientRegistry         $clientRegistry,
                                private RouterInterface        $router,
                                private GetGoogleUser          $getGoogleUser)
    {
    }

    /**
     * @param Request $request
     * @return bool|null
     */
    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'google_auth';
    }

    /**
     * @param Request $request
     * @return PassportInterface
     */
    public function authenticate(Request $request): PassportInterface
    {
        $client = $this->clientRegistry->getClient('google');
        $accessToken = $this->fetchAccessToken($client);
        return new SelfValidatingPassport(
            new UserBadge((string)$accessToken,
                function () use ($accessToken, $client) {
                    return $this->getGoogleUser->getUser($accessToken, $client);
                }),
        );
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return Response|null
     */
    public
    function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
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






