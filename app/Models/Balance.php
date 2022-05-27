<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'amount',
        'balance',
        'user_id',
        'user_name',
        'description'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
