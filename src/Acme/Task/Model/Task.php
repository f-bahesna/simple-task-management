<?php
declare(strict_types=1);

namespace Acme\Task\Model;

use Acme\Project\Relation\BelongsToProject;
use Pandawa\Component\Ddd\AbstractModel;

/**
 * @property string $name
 * @property int $priority
 * @author frada <fbahezna@gmail.com>
 */
class Task extends AbstractModel
{
    use BelongsToProject;
    protected $fillable = [
        'name'
    ];
}