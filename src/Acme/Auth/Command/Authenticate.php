<?php
declare(strict_types=1);

namespace Acme\Auth\Command;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class Authenticate extends AbstractCommand implements NameableMessageInterface
{
    use NameableClassTrait;

    private string $username;
    private string $password;
    private string $type;
    private ?string $token;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getToken(): ?string
    {
        return $this->token ?? null;
    }
}