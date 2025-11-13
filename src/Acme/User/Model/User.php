<?php
declare(strict_types=1);

namespace Acme\User\Model;

use Acme\User\Value\Password;
use Illuminate\Auth\Authenticatable;
use Pandawa\Component\Ddd\AbstractModel;
use Pandawa\Module\Api\Security\Contract\SignableUserInterface;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * @property string $name
 * @property Password $password
 * @author frada <fbahezna@gmail.com>
 */
class User extends AbstractModel implements AuthenticatableContract, SignableUserInterface
{
    use Authenticatable;
    protected $hidden = [
        'password',
        'allowed_ips',
        'remember_token'
    ];

    protected $fillable = [
        'username',
        'email',
        'name',
        'password',
    ];

    public function getSignPayload(): array
    {
        return [
            'sub'   => $this->id,
            'username' => $this->name
        ];
    }
}