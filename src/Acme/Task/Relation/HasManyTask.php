<?php
declare(strict_types=1);

namespace Acme\Task\Relation;

use Acme\Task\Model\Task;
use Pandawa\Component\Ddd\Relationship\HasMany;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
trait HasManyTask
{
    use RelationshipBehaviorTrait;

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}