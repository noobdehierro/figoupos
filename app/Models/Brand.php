<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'logo',
        'is_primary',
        'is_active'
    ];

    public function parent()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @param bool $is_paginate
     * @return Brand[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getBrandsByUserBrand(bool $is_paginate = true)
    {
        $user = auth()->user();

        if ($user->can('super')) {
            if ($is_paginate) {
                $brands = Brand::paginate(10);
            } else {
                $brands = Brand::all();
            }
        } else {
            $brand_id = $user->primary_brand_id;

            if ($is_paginate) {
                $brands = Brand::where('id', $brand_id)->paginate(10);
            } else {
                $brands = Brand::where('id', '=', $brand_id)->get();
            }
        }

        return $brands;
    }
}
