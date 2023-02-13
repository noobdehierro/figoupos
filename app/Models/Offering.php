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
        'seller_price',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public static function getOfferingsByUserBrand(bool $is_paginate = true)
    {
        $user = auth()->user();

        if ($user->can('super')) {
            if ($is_paginate) {
                $offerings = Offering::paginate(25);
            } else {
                $offerings = Offering::all();
            }
        } else {
            $brand_id = $user->primary_brand_id;

            if ($is_paginate) {
                $offerings = Offering::where('brand_id', $brand_id)->paginate(
                    10
                );
            } else {
                $offerings = Offering::where('brand_id', $brand_id)->get();
            }
        }

        return $offerings;
    }
}
