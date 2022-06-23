<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'brand_id',
        'primary_brand_id',
        'sales_limit',
        'is_active'
    ];

    public $sortable = [
        'id',
        'name',
        'email',
        'sales_limit',
        'is_active',
        'created_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    protected $with = ['account'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    /**
     * @param bool $is_paginate
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getUsersByBrand(bool $is_paginate = true)
    {
        $user = auth()->user();

        if ($user->can('super')) {
            if ($is_paginate) {
                $users = User::sortable()->paginate(10);
            } else {
                $users = User::all();
            }
        } else {
            $brand_id = $user->brand_id;
            $parents = Brand::select('id')
                ->where('parent_id', $brand_id)
                ->orWhere('id', $brand_id);

            if ($is_paginate) {
                $users = User::whereIn('brand_id', $parents)->sortable()->paginate();
            } else {
                $users = User::whereIn('brand_id', $parents)->get();
            }
        }

        return $users;
    }

    public static function getRolesByRole()
    {
        $user = auth()->user();

        if ($user->can('super')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('id', '>=', $user->role_id)->get();
        }

        return $roles;
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
            $brand_id = $user->brand_id;
            $parents = Brand::select('id')
                ->where('parent_id', $brand_id)
                ->orWhere('id', $brand_id);

            if ($is_paginate) {
                $brands = Brand::whereIn('parent_id', $parents)
                    ->orWhere('id', $brand_id)
                    ->orderBy('name')
                    ->paginate(10);
            } else {
                $brands = Brand::whereIn('parent_id', $parents)
                    ->orWhere('id', $brand_id)
                    ->orderBy('name')
                    ->get();
            }
        }

        return $brands;
    }
}
