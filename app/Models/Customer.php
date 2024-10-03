<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'phone_number',
        'email',
        'country',
    ];

    protected $with = [
        'address'
    ];
    /**
     * @return [type]
     */
    public function address()
    {
        return $this->hasMany(
            CustomerAddress::class
        );
    }
}
