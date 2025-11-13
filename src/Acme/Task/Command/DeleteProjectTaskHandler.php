<?php
declare(strict_types=1);

namespace Acme\Task\Command;

use Acme\Task\Model\Task;
use Acme\Task\Repository\TaskRepository;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class DeleteProjectTaskHandler
{
    public function __construct(
        private TaskRepository $taskRepository,
    )
    {
    }

    public function handle(DeleteProjectTask $command): Task
    {
        if(null !== $task = $this->taskRepository->find($command->getTask())){

            $this->taskRepository->remove($task);

            return $task;
        }

        throw new \LogicException('Task not found', 404);
    }
}