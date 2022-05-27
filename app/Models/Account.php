<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'brand_id',
        'name',
        'amount',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
    }

    public static function getAccountsByUserBrand(bool $is_paginate = true)
    {
        $user = auth()->user();

        if ($user->can('super')) {
            if ($is_paginate) {
                $accounts = Account::paginate(10);
            } else {
                $accounts = Account::all();
            }
        } else {
            $brand_id = $user->primary_brand_id;

            if ($is_paginate) {
                $accounts = Account::where('brand_id', $brand_id)->paginate(10);
            } else {
                $accounts = Account::where('brand_id', $brand_id)->get();
            }
        }

        return $accounts;
    }

    public static function getUsersByBrand()
    {
        $user = auth()->user();

        if ($user->can('super')) {
            $users = User::all();
        } else {
            $primary_brand_id = $user->primary_brand_id;
            $users = User::where('primary_brand_id', $primary_brand_id)->get();
        }

        return $users;
    }

    public static function getBrandsByUserBrand()
    {
        $user = auth()->user();

        if ($user->can('super')) {
            $brands = Brand::all();
        } else {
            $primary_brand_id = $user->primary_brand_id;
            $brands = Brand::where('id', $primary_brand_id)
                ->orWhere('parent_id', $primary_brand_id)
                ->get();
        }

        return $brands;
    }
}
