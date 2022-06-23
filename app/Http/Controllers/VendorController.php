<?php

namespace App\Http\Controllers;

use App\Exports\VendorsExport;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;


class VendorController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('adminhtml.vendors.index', [
            'users' => $users
        ]);
    }

    public function show()
    {
        $orders = Order::select(
            'user_id',
            'user_name',
            'brand_name',
            Order::raw('sum(case when user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_ventas'),
            Order::raw("sum(case when sales_type = 'Recarga' and user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_recargas"),
            Order::raw("sum(case when sales_type = 'Contratación' and user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_contrataciones")
        )
            ->groupBy('user_id', 'user_name', 'brand_name')
            ->FilterVendors(request(['initDate', 'endDate', 'payment_method', 'sales_type', 'user_name']))
            ->get();

            // Order::select(
            //     'orders.user_id',
            //     'user_name',
            //     'brand_name',
            //     'accounts.amount',
            //     Order::raw('sum(case when orders.user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_ventas'),
            //     Order::raw("sum(case when sales_type = 'Recarga' and orders.user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_recargas"),
            //     Order::raw("sum(case when sales_type = 'Contratación' and orders.user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_contrataciones")
            // )->leftjoin('accounts', 'accounts.user_id', '=', 'orders.user_id')
            //     ->groupBy('user_id', 'user_name', 'brand_name', 'accounts.amount')
            //     ->FilterVendors(request(['initDate', 'endDate', 'payment_method', 'sales_type', 'user_name']))
            //     ->get();

        return view('adminhtml.vendors.show', ['orders' => $orders]);
    }

    public function export()
    {

        return (new VendorsExport(
            request()->all()
        )
        )->download('vendors.xlsx');
    }
}
