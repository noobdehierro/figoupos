<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Order extends Model
{
    use HasFactory;
    use Sortable;


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
        'total',
        'seller_price'
    ];

    public $sortable = [
        'id',
        'brand_name',
        'name',
        'sales_type',
        'payment_method',
        'status',
        'total',
        'created_at'
    ];

    protected $with = ['user'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getOrdersByUserBrand(bool $is_paginate = true)
    {
        $user = auth()->user();

        if ($user->can('super')) {
            if ($is_paginate) {
                $orders = Order::sortable()->paginate(5);
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
                    $orders = Order::whereIn('brand_id', $parents)->sortable()->paginate(
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
                        ->sortable()->paginate(10);
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

        $brand = auth()->user()->brand_id;

        $query->when($brand, function ($query) use ($brand) {
            $query->where('brand_id', $brand);
        });

        $query->when($filters['initDate'] ?? false, function ($query) use ($filters) {
            $query->when($filters['endDate'] ?? false, function ($query) use ($filters) {
                $query->whereBetween('created_at', [
                    $filters['initDate'],
                    $filters['endDate']
                ]);
            }, function ($query) use ($filters) {
                $query->where('created_at', '>=', $filters['initDate']);
            });
        });

        $query->when($filters['payment_method'] ?? false, function ($query) use ($filters) {
            if ($filters['payment_method'] == 'null') {
                $query->whereNull('payment_method');
            } else {
                $query->where('payment_method', $filters['payment_method']);
            }
        });

        $query->when($filters['sales_type'] ?? false, function ($query) use ($filters) {
            $query->where('sales_type', $filters['sales_type']);
        });
    }

    public function scopeFilterVendors($query, array $filters)
    {

        $brand = auth()->user()->brand_id;

        $query->when($brand, function ($query) use ($brand) {
            $query->where('orders.brand_id', $brand);
        });

        $query->when($filters['initDate'] ?? false, function ($query) use ($filters) {
            $query->when($filters['endDate'] ?? false, function ($query) use ($filters) {
                $query->whereBetween('created_at', [
                    $filters['initDate'],
                    $filters['endDate']
                ]);
            }, function ($query) use ($filters) {
                $query->where('created_at', '>=', $filters['initDate']);
            });
        });

        $query->when($filters['payment_method'] ?? false, function ($query) use ($filters) {
            if ($filters['payment_method'] == 'null') {
                $query->whereNull('payment_method');
            } else {
                $query->where('payment_method', $filters['payment_method']);
            }
        });

        $query->when($filters['sales_type'] ?? false, function ($query) use ($filters) {
            $query->where('sales_type', $filters['sales_type']);
        });

        $query->when($filters['user_name'] ?? false, function ($query) use ($filters) {
            $query->where('user_name', $filters['user_name']);
        });
    }
}