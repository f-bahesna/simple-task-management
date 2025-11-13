<?php
declare(strict_types=1);

namespace Acme\Task\Repository;

use Pandawa\Component\Ddd\Collection;
use Pandawa\Component\Ddd\Repository\Repository;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class TaskRepository extends Repository
{
    public function setReorderedTasks(array $tasks): Collection
    {
        $qb = $this->createQueryBuilder();

        foreach ($tasks as $index => $id) {
            $qb
                ->where('id', $id)
                ->update(['priority' => $index + 1]);
        }


        return $this->execute($qb);
    }
}