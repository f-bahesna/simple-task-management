<?php
declare(strict_types=1);

namespace Acme\Project\Transformer;

use Acme\Project\Model\Project;
use Pandawa\Component\Transformer\TransformerInterface;

/**
 * @author frada <fbahezna@gmail.com>
 */
class ProjectTasksReorderAscTransformer implements TransformerInterface
{
    public function transform($data, array $tags = [])
    {
        return array_merge(
            [
                'id' => $data->id,
                'name' => $data->name,
                'created_at' => $data->created_at,
                'tasks' => collect($data->tasks)->sortBy('priority')->toArray()
            ],
        );
    }

    public function support($data, array $tags = []): bool
    {
        return $data instanceof Project && in_array('project-task-reorder', $tags);
    }
}