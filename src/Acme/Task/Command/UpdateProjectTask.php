<?php
declare(strict_types=1);

namespace Acme\Task\Command;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
class UpdateProjectTask extends AbstractCommand implements NameableMessageInterface
{
    use NameableClassTrait;

    public string $project;
    public string $task;
    public string $name;

    public function getProject(): string
    {
        return $this->project;
    }

    public function getTask(): string
    {
        return $this->task;
    }

    public function getName(): string
    {
        return $this->name;
    }
}