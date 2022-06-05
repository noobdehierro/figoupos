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
        'brand_id',
        'brand_name',
        'channel',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getOrdersByUserBrand(bool $is_paginate = true)
    {
        $user = auth()->user();

        if ($user->can('super')) {
            if ($is_paginate) {
                $orders = Order::paginate(10);
            } else {
                $orders = Order::all();
            }
        } else {
            $brand_id = $user->primary_brand_id;

            if ($user->can('admin')) {
                $parents = Brand::select('id')
                    ->where('id', $brand_id)
                    ->orWhere('parent_id', $brand_id);

                if ($is_paginate) {
                    $orders = Order::whereIn('brand_id', $parents)->paginate(
                        10
                    );
                } else {
                    $orders = Order::whereIn('brand_id', $parents)->get();
                }
            } else {
                $parents = Brand::select('id')
                    ->where('id', $brand_id)
                    ->orWhere('parent_id', $brand_id);

                if ($is_paginate) {
                    $orders = Order::whereIn('brand_id', $parents)
                        ->where('user_id', $user->id)
                        ->paginate(10);
                } else {
                    $orders = Order::whereIn('brand_id', $parents)
                        ->where('user_id', $user->id)
                        ->get();
                }
            }
        }

        return $orders;
    }

    public function scopeFilterOrders($query, array $filters)
    {

        $query->when($filters['initDate'], function ($query) use ($filters) {
            $query->when($filters['endDate'], function ($query) use ($filters) {
                $query->whereBetween('created_at', [
                    $filters['initDate'],
                    $filters['endDate']
                ]);
            }, function ($query) use ($filters) {
                $query->where('created_at', '>=', $filters['initDate']);
            });
        });

        $query->when($filters['payment_method'], function ($query) use ($filters) {
            if($filters['payment_method'] == 'null'){
                $query->whereNull('payment_method');
            }else{
                $query->where('payment_method', $filters['payment_method']);
            }
        });

        $query->when($filters['sales_type'], function ($query) use ($filters) {
           $query->where('sales_type', $filters['sales_type']);
        });


    }
}
