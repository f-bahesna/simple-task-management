<?php
declare(strict_types=1);

namespace Acme\Project\Service;

use Acme\Project\Command\CreateProjectTask;
use Acme\Project\Model\Project;
use Acme\Project\Repository\ProjectRepository;
use Acme\Task\Model\Task;
use Acme\Task\Repository\TaskRepository;
use LogicException;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ProjectTaskCreator
{
    public function __construct(private ProjectRepository $projectRepository, private TaskRepository $taskRepository)
    {
    }

    public function create(CreateProjectTask $command): Project
    {
       if(null !== $project = $this->projectRepository->find($command->getProject())) {
           $priority = $this->taskRepository->findBy(['project_id' => $project->getId()])->count() + 1;

            $task = new Task();
            $task->name = $command->getName();
            $task->priority = $priority;

            $task->project()->associate($project);

            $this->taskRepository->save($task);

            return $project;
       }

       throw new LogicException('Project not found', 409);
    }
}