<?php
declare(strict_types=1);

namespace Acme\Task\Service;

use Acme\Project\Model\Project;
use Acme\Task\Model\Task;
use Acme\Task\Repository\TaskRepository;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ProjectTaskUpdater
{
    public function __construct(
        private TaskRepository $taskRepository,
    )
    {
    }

    public function update(Project $project, Task $task, string $name): Task
    {
//        $priority = $this->taskRepository->findBy(['project_id' => $project->getId()])->count() + 1;

        $task->name = $name;
//        $task->priority = $priority;

        return $task;
    }
}