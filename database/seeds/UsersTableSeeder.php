<?php
declare(strict_types=1);

use Acme\User\Model\User;
use Acme\User\Repository\UserRepository;
use Acme\User\Value\Password;
use Illuminate\Database\Seeder;

/**
 * @author frada <fbahezna@gmail.com>
 */
class UsersTableSeeder extends Seeder
{
    private array $users = [
        [
            'email'    => 'support@mycompany.id',
            'name'     => 'Admin',
            'password' => 'passwordAdmin',
        ],
    ];

    public function run(): void
    {
        foreach ($this->users as $item) {
            $user = new User(array_except($item, ['password', 'roles']));

            if (null !== $password = array_get($item, 'password')) {
                $user->password = Password::create($password);
            }

            $this->repository()->save($user);
        }
    }

    /**
     * @return UserRepository
     */
    private function repository(): UserRepository
    {
        return app()->get(UserRepository::class);
    }
}