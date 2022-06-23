<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Gestor de vendedores</h5>
            <a id="add"
                href="/vendors/orders/export/?{{ http_build_query(request()->except('_token', '_method')) }}"
                title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>exportar</span>
            </a>
        </div>
    </div>

    {{-- /sales/orders/export/{{ http_build_query(request()->except('_token', '_method')) == '' ? 'data=all' : http_build_query(request()->except('_token', '_method')) }} --}}

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Vendedor</th>
                                            <th>Marca</th>
                                            <th>Saldo en cuenta</th>
                                            <th>No. de ventas</th>
                                            <th>No. de recargas</th>
                                            <th>No. de contrataciones</th>


                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->user_id }}</td>
                                                <td>{{ $order->user_name }}</td>
                                                <td>{{ $order->brand_name }}</td>
                                                <td>{{ $order->user->account->amount }}</td>
                                                <td>{{ $order->No_ventas }}</td>
                                                <td>{{ $order->No_recargas }}</td>
                                                <td>{{ $order->No_contrataciones }}</td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
