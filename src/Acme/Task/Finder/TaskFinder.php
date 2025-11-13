<?php
declare(strict_types=1);

namespace Acme\Task\Finder;

use Acme\Task\Model\Task;
use Pandawa\Component\Ddd\Finder\AbstractModelFinder;

/**
 * @author frada <fbahezna@gmail.com>
 */
class TaskFinder extends AbstractModelFinder
{
    protected function getModelClass(): string
    {
        return Task::class;
    }
}