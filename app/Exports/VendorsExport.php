<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendorsExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            'id',
            'Vendedor',
            'Marca',
            'Saldo en cuenta',
            'No. de ventas',
            'No. de recargas',
            'No. de contrataciones'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {


        $orders = Order::select(
            'orders.user_id',
            'user_name',
            'brand_name',
            'accounts.amount',
            Order::raw('sum(case when orders.user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_ventas'),
            Order::raw("sum(case when sales_type = 'Recarga' and orders.user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_recargas"),
            Order::raw("sum(case when sales_type = 'Contratación' and orders.user_id in (select user_id from igoupos.orders) then 1 else 0 end ) as No_contrataciones")
        )->leftjoin('accounts', 'accounts.user_id', '=', 'orders.user_id')
            ->groupBy('orders.user_id', 'user_name', 'brand_name', 'accounts.amount')->orderBy('user_name', 'asc')
            ->FilterVendors(request(['initDate', 'endDate', 'payment_method', 'sales_type', 'user_name']));

        return $orders;
    }
}
