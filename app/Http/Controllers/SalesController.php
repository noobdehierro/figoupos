<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;

class SalesController extends Controller
{
    public function index()
    {
        return view('adminhtml.sales.index');
    }

    public function show()
    {
        $orders = Order::latest()->filterOrders(request(['initDate', 'endDate', 'payment_method', 'sales_type']))->get();
        return view('adminhtml.sales.show', ['orders' => $orders]);
    }

    public function export()
    {
        return (new OrdersExport(
            request()->all()
        )
        )->download('Sales.xlsx');
    }
}
