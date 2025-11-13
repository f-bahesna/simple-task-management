<?php
declare(strict_types=1);

namespace Acme\Project\Command;

use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
class CreateProjectTask extends AbstractCommand implements NameableMessageInterface
{
    use NameableClassTrait;

    public string $name;
    public string $project;

    public function getName(): string
    {
        return $this->name;
    }

    public function getProject(): string
    {
        return $this->project;
    }
}