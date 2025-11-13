<?php
declare(strict_types=1);

namespace Acme\Task\Command;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
class ReorderProjectTask extends AbstractCommand implements NameableMessageInterface
{
    use NameableClassTrait;

    private string $project;
    private array $tasks;

    public function getProject(): string
    {
        return $this->project;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }
}