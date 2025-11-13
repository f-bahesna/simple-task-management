<?php
declare(strict_types=1);

namespace Acme\Auth\Value;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class Signature implements Arrayable
{
    public function __construct(
        private string $token,
        private string $type,
        private array $attributes
    )
    {
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function toArray()
    {
        return array_merge(
            $this->attributes,
            [
                'token' => $this->getToken(),
                'type' => $this->type
            ]
        );
    }
}