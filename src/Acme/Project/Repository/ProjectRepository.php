<?php
declare(strict_types=1);

namespace Acme\Project\Repository;

use Pandawa\Component\Ddd\Repository\Repository;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class ProjectRepository extends Repository
{
//    public function findAscTasks()
//    {
//        $qb = $this->createQueryBuilder();
//
//        $qb
//            ->select('projects.*')
//            ->join('tasks', 'tasks.project_id', 'projects.id')
//            ->orderBy('tasks.priority', 'ASC')
//        ;
//
//        return $this->execute($qb);
//    }
}