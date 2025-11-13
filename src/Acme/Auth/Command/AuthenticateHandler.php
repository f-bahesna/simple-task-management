<?php
declare(strict_types=1);

namespace Acme\Auth\Command;

use Acme\Auth\DTO\AuthenticateDTO;
use Acme\Auth\Service\AuthenticationService;
use Illuminate\Auth\AuthenticationException;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class AuthenticateHandler
{
    public function __construct(
        private AuthenticationService $service,
    )
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function handle(Authenticate $message)
    {
        $payload = new AuthenticateDTO(
            [
                'username' => $message->getUsername(),
                'password' => $message->getPassword(),
                'token'  => $message->getToken()
            ]
        );

        return $message->getType() === 'basic'
            ?
            $this->service->basicLogin($payload)
            :
            $this->service->socialLogin($payload);
    }
}