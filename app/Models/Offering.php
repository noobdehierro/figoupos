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
            $brand_id = $user->brand_id;
            $parent_id = $user->brand->parent_id;

            $brand = Brand::select('id')
                ->where('id', $parent_id)
                ->where('is_primary', 1)
                ->whereNotNull('parent_id')
                ->orWhere('id', $brand_id)
                ->where('is_primary', 1);

            if ($is_paginate) {
                $offerings = Offering::whereIn('brand_id', $brand)->paginate(
                    10
                );
            } else {
                $offerings = Offering::whereIn('brand_id', $brand)->get();
            }
        }

        return $offerings;
    }
}
