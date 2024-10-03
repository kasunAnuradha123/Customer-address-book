<?php

namespace App\Repositories\Eloquent\Customer;

use App\Models\Customer;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
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
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
}
