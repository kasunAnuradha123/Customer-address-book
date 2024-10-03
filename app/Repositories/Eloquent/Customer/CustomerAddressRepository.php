<?php

namespace App\Repositories\Eloquent\Customer;

use App\Models\CustomerAddress;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Customer\CustomerAddressRepositoryInterface;

class CustomerAddressRepository extends BaseRepository implements CustomerAddressRepositoryInterface
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
    public function __construct(CustomerAddress $model)
    {
        $this->model = $model;
    }
}
