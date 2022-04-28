<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'sales_type',
        'user_id',
        'user_name',
        'qv_offering_id',
        'imei',
        'name',
        'lastname',
        'email',
        'telephone',
        'birday',
        'iccid',
        'street',
        'outdoor',
        'indoor',
        'references',
        'postcode',
        'suburb',
        'city',
        'region',
        'payment_method',
        'brand_name',
        'channel',
        'total'
    ];
}
