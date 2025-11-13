<?php
declare(strict_types=1);

namespace Acme\Auth\Service;

use Acme\Auth\DTO\AuthenticateDTO;
use Acme\Auth\Value\Signature;
use Acme\User\Finder\UserFinder;
use Illuminate\Auth\AuthenticationException;
use Pandawa\Module\Api\Security\Authentication\AuthenticationManager;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class AuthenticationService
{
    public function __construct(
        private AuthenticationManager $authenticationManager,
        private UserFinder $userFinder
    )
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function basicLogin(AuthenticateDTO $DTO): Signature
    {
        $username = $DTO->get('username');
        $password = $DTO->get('password');

        try {
            if(null === $user = $this->userFinder->findByCredentialOrFail($username)){
                throw new AuthenticationException(__('The given username or password is invalid'));
            }

            if(!$password){
                throw new AuthenticationException(__('The given username or password is invalid'));
            }

            $signature = $this->authenticationManager->sign('jwt', $user);

            return new Signature($signature->getCredentials(), 'Bearer', $signature->getAttributes());

        }catch (AuthenticationException $exception){
            //TODO: maybe need throttles login attempt
            throw new AuthenticationException($exception->getMessage());
        }
    }

    public function socialLogin(AuthenticateDTO $DTO): Signature
    {
        throw new \LogicException("this function not created yet.");
    }
}