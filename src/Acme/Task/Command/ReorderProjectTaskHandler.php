<?php
declare(strict_types=1);

namespace Acme\Task\Command;

use Acme\Project\Model\Project;
use Acme\Project\Repository\ProjectRepository;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ReorderProjectTaskHandler
{
    public function __construct(
        private ProjectRepository $projectRepository,
    )
    {
    }

    public function handle(ReorderProjectTask $command): Project
    {
        if(null !== $project = $this->projectRepository->find($command->getProject())){
            collect($project->tasks)->each(function ($baseTask) use ($command) {
                collect($command->getTasks())->each(function($updateTask, $key) use ($baseTask){
                   if($baseTask->id === $updateTask){
                       $baseTask->priority = $key + 1;
                   }
                });
            });

            $this->projectRepository->save($project);

            return $project;
        }

        Throw new \LogicException('Project not found', 409);
    }
}