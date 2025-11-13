<?php
declare(strict_types=1);

namespace Acme\Project\Command;

use Acme\Project\Model\Project;
use Acme\Project\Service\ProjectTaskCreator;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class CreateProjectTaskHandler
{
    public function __construct(private ProjectTaskCreator $creator)
    {
    }

    public function handle(CreateProjectTask $command): Project
    {
        return $this->creator->create($command);
    }
}