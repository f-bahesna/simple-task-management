<?php
declare(strict_types=1);

namespace Acme\Project\Relation;

use Acme\Project\Model\Project;
use Pandawa\Component\Ddd\Relationship\BelongsTo;
use Pandawa\Component\Ddd\RelationshipBehaviorTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
trait BelongsToProject
{
    use RelationshipBehaviorTrait;

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}