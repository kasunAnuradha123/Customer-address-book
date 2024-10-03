<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'customer_id',
    ];
    protected $casts = [
        'customer_id' => 'array'
    ];
    protected $appends = [
        'customers'
    ];

    /**
     * @return [type]
     */
    public function getCustomersAttribute(){
        $customers = $this->customer_id;
        return Customer::whereIn('id', $customers)->get();
    }
}
