<?php
declare(strict_types=1);

namespace Acme\Task\Command;

use Acme\Project\Repository\ProjectRepository;
use Acme\Task\Model\Task;
use Acme\Task\Repository\TaskRepository;
use Acme\Task\Service\ProjectTaskUpdater;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class UpdateProjectTaskHandler
{
    public function __construct(
        private ProjectTaskUpdater $updater,
        private TaskRepository $taskRepository,
        private ProjectRepository $projectRepository,
    )
    {
    }

    public function handle(UpdateProjectTask $command): Task
    {
        if(null !== $task = $this->taskRepository->find($command->getTask())){
            $project = $this->projectRepository->find($command->getProject());

            $updater = $this->updater->update($project, $task, $command->getName());

            return $this->taskRepository->save($updater);
        }

        throw new \LogicException('task not found', 409);
    }
}