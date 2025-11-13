<?php
declare(strict_types=1);

namespace Acme\User\Finder;

use Acme\User\Model\User;
use Pandawa\Component\Ddd\Finder\AbstractModelFinder;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class UserFinder extends AbstractModelFinder
{
    protected function getModelClass(): string
    {
        return User::class;
    }

    public function findByCredentialOrFail(string $credential): ?User
    {
        if(null !== $user = $this->repo()->findByCredential($credential)){
            return $user;
        }

        return null;
    }
}