<?php
declare(strict_types=1);

namespace Acme\Project\Model;

use Acme\Task\Relation\HasManyTask;
use Pandawa\Component\Ddd\AbstractModel;

/**
 * @property string $name
 * @author frada <fbahezna@gmail.com>
 */
class Project extends AbstractModel
{
    use HasManyTask;
    protected $fillable = [
        'name'
    ];
}