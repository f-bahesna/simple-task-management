<?php
declare(strict_types=1);

namespace Acme\Shared\DTO;

use Borobudur\Component\Parameter\ImmutableParameter;

/**
 * @author frada <fbahezna@gmail.com>
 */
class GlobalDTO
{
    private ImmutableParameter $payload;

    /**
     * @param ImmutableParameter $payload
     */
    public function __construct(array $payload)
    {
        $this->payload = new ImmutableParameter($payload);
    }

    public function get(string $key, $default = null)
    {
        return $this->payload->get($key, $default);
    }

    public function has(string $key): bool
    {
        return $this->payload->has($key);
    }

    public function all(): array
    {
        return $this->payload->all();
    }
}