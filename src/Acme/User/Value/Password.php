<?php
declare(strict_types=1);

namespace Acme\User\Value;

use Pandawa\Component\Serializer\DeserializableInterface;
use Pandawa\Component\Serializer\SerializableInterface;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class Password implements SerializableInterface, DeserializableInterface
{
    const DEFAULT_COST = 11;

    /**
     * @var array $options
     * @var array $algo
     * @var string $hashed
     */
    public function __construct(
        private array $options,
        private array $algo,
        private string $hashed
    )
    {
        $hashed = $this->hashed;

        $this->algo['code'] = '2y';

        if(!$this->isHashed($hashed)){
            throw new \InvalidArgumentException('Password are not hashed or invalid hashed', 422);
        }

        $this->hashed = $hashed;
    }

    public static function create(string $password, int $cost = self::DEFAULT_COST): Password
    {
        $options = ['cost' => $cost];
        $algo = ['code' => PASSWORD_BCRYPT, 'name' => 'bcrypt'];

        return new self($options, $algo, self::hash($password, $algo['code'], $options));
    }

    public static function deserialize($data)
    {
        $data = json_decode($data, true);

        return new self($data['options'], $data['algo'], $data['hashed']);
    }

    public function serialize()
    {
        return json_encode(
            [
                'options' => $this->options,
                'algo'  => $this->algo,
                'hashed'    => $this->hashed
            ]
        );
    }

    public function matches(string $password): bool
    {
        return password_verify($password, $this->hashed);
    }

    public function isHashed(string $password): bool
    {
        $expected = [
            'algo'  => $this->algo['code'],
            'algoName' => $this->algo['name'],
            'options'   => [
                'cost'  => $this->options['cost'],
            ]
        ];

        return $expected === password_get_info($password);
    }

    private static function hash(string $password, $algo, array $options): string
    {
        return password_hash($password, $algo, $options);
    }
}