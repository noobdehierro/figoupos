<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Gestor de usuarios</h5>
            <a id="add" href="{{ route('users.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Añadir usuario</span>
            </a>
        </div>
    </div>


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
                                            <th>Status</th>
                                            <th>método de pago</th>
                                            <th>Tipo de venta</th>
                                            <th>Monto</th>
                                            <th>Fecha</th>
                                            <th>Marca</th>
                                            <th>Vendedor</th>


                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ $order->payment_method ? $order->payment_method : '- - - - - - -' }}
                                                </td>
                                                <td>{{ $order->sales_type }} </td>
                                                <td>{{ $order->total }}</td>
                                                <td>{{$order->created_at}}</td>
                                                <td>{{ $order->brand_name }}</td>
                                                <td>{{ $order->user_name }}</td>
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
