<?php

namespace App\Repositories\Eloquent\Project;

use App\Models\Project;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Project\ProjectRepositoryInterface;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(Project $model)
    {
        $this->model = $model;
    }
}
