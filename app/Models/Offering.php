<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    use HasFactory;

    protected $fillable = [
        'qv_offering_id',
        'name',
        'description',
        'promotion',
        'price',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
