<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Brand extends Model
{
    use HasFactory;
    use Sortable;

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

    public $sortable = [
        'id',
        'name',
        'description',
        'parent_id',
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
                $brands = Brand::sortable()->paginate(10);
            } else {
                $brands = Brand::all();
            }
        } else {
            $brand_id = $user->brand_id;

            if ($is_paginate) {
                $brands = Brand::where('parent_id', $brand_id)->sortable()->paginate(10);
            } else {
                $brands = Brand::where('id', '=', $brand_id)->get();
            }
        }

        return $brands;
    }
}
