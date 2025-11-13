<?php
declare(strict_types=1);

namespace Acme\User\Repository;

use Acme\User\Model\User;
use Pandawa\Component\Ddd\Repository\Repository;

/**
 * @author frada <fbahezna@gmail.com>
 */
class UserRepository extends Repository
{
    public function findByCredential(string $credential): ?User
    {
        $qb = $this->createQueryBuilder();

        $qb
            ->where('name', $credential)
            ->orWhere('email', $credential)
        ;

        return $this->executeSingle($qb);
    }
}