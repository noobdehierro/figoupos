<x-app-layout>
    @if(!empty($infoMsg))
        <x-flash type="warning" dismiss="yes">{{ $infoMsg }}</x-flash>
    @endif
    <div class="card">
        <div class="card-header top-card">
            <h5>Contratación</h5>
        </div>
    </div>
    @if($order)
        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="float-left">Tiene una solicitud pendiente de pago</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a class="btn btn-primary" href="{{ route('purchase.payment', $order->id) }}">Continuar</a>
                                        <x-form action="{{ route('purchase.update',$order->id) }}" method="PATCH" style="display: inline-block">
                                            <x-confirm id="purchase-alert" action="Cancelar orden">¿Esta seguro de cancelar esta orden?</x-confirm>
                                        </x-form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">Cliente</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr class="text-dark">
                                        <td>Nombre</td>
                                        <td>:</td>
                                        <td>{{ $order->name . ' ' . $order->lastname }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Correo electrónico</td>
                                        <td>:</td>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Teléfono</td>
                                        <td>:</td>
                                        <td>{{ $order->telephone }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Fecha de nacimiento</td>
                                        <td>:</td>
                                        <td>{{ $order->birday }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">Dirección</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr class="text-dark">
                                        <td>Calle y numero</td>
                                        <td>:</td>
                                        <td>{{ $order->street . ' ' . $order->outdoor . ' ' . $order->indoor }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Colonia y municipio</td>
                                        <td>:</td>
                                        <td>{{ $order->suburb . ' ' . $order->city }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>C.P. y estado</td>
                                        <td>:</td>
                                        <td>{{ $order->postcode . ' ' . $order->region }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Referencias</td>
                                        <td>:</td>
                                        <td>{{ $order->references }}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">SIM</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr class="text-dark">
                                        <td>IMEI</td>
                                        <td>:</td>
                                        <td>{{ $order->imei }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>ICCID</td>
                                        <td>:</td>
                                        <td>{{ $order->iccid }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Marca</td>
                                        <td>:</td>
                                        <td>{{ $order->brand_name }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Canal</td>
                                        <td>:</td>
                                        <td>{{ $order->channel }}</td>
                                    </tr
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">Producto</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr class="text-dark">
                                        <td>Método de pago</td>
                                        <td>:</td>
                                        <td class="text-c-blue">{{ $order->payment_method }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>ID</td>
                                        <td>:</td>
                                        <td>{{ $order->qv_offering_id }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Fecha de operación</td>
                                        <td>:</td>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Total</td>
                                        <td>:</td>
                                        <td>{{ $order->total }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    @else
    <div class="pannel active" id="offering">
        <div class="row">
            @foreach($offerings as $offering)
                <x-offering id="{{ $offering->id }}" brand="{{ $offering->brand->name }}" action="Seleccionar">
                    <x-slot name="name">{{ $offering->name }}</x-slot>
                    <x-slot name="price">{{ $offering->price }}</x-slot>
                    <x-slot name="seller_price">{{ $offering->seller_price }}</x-slot>
                    <x-slot name="description">
                        {!! $offering->description !!}
                    </x-slot>
                    <x-slot name="action_route">{{ route('purchase.create', $offering->id) }}</x-slot>
                </x-offering>
            @endforeach
        </div>
    </div>
    @endif
</x-app-layout>
