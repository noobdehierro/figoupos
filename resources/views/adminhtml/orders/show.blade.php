<x-app-layout>
    <style>
        pre {
            overflow: auto;
            /* height: 100px; */
        }
    </style>
    <div class="card">
        <div class="card-header top-card">
            <h5>Detalle de orden <span class="text-primary"># {{ $order->id }}</span></h5>
            <a id="cancel" href="{{ route('orders.index') }}" title="Regresar" type="button"
                class="btn btn-secondary top-card-link">
                <span>Regresar</span>
            </a>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-left">Estatus: <span
                                    class="text-c-blue">{{ $order->status }}</span><br />Tipo: <span
                                    class="text-dark">{{ $order->sales_type }}</span></h4>
                            <h4 class="float-right">Vendedor: {{ $order->user_name }}</h4>
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
                                        <td>MSISDN</td>
                                        <td>:</td>
                                        <td class="text-c-blue">{{ $order->msisdn }}</td>
                                    </tr>
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
                                    </tr>
                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="mt-1 mb-3">Pago</h5>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="text-dark">
                                        <td>Método de pago</td>
                                        <td>:</td>
                                        <td class="text-c-blue">{{ $order->payment_method }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Id de pago</td>
                                        <td>:</td>
                                        <td class="text-c-blue">{{ $order->payment_id }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Referencia</td>
                                        <td>:</td>
                                        <td class="text-c-blue">{{ $order->reference_id }}</td>
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
                                        <td><span class="f-w-700">Total</span></td>
                                        <td>:</td>
                                        <td><span class="f-w-700">${{ $order->total }} MXN</span> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="mt-1 mb-3">Eventos</h5>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="text-dark ">
                                        <td>operación</td>
                                        <td>:</td>
                                        <td>{{ $event->operacion }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>order_id</td>
                                        <td>:</td>
                                        <td>{{ $event->id }}</td>

                                    </tr>
                                    <tr class="text-dark">
                                        <td>client_id</td>
                                        <td>:</td>
                                        <td>{{ $event->id }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>client_name</td>
                                        <td>:</td>
                                        <td>{{ $event->client_name }}</td>

                                    </tr>
                                    <tr class="text-dark">
                                        <td>api_key</td>
                                        <td>:</td>
                                        <td class="text-c-blue">{{ $event->api_key }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>api_endpoint</td>
                                        <td>:</td>
                                        <td class="text-c-blue">{{ $event->api_endpoint }}</td>

                                    </tr>
                                    <tr class="text-dark">
                                        <td>request</td>
                                        <td>:</td>
                                        <td id="request"></td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>code</td>
                                        <td>:</td>
                                        <td>{{ $event->code }}</td>

                                    </tr>

                                    <tr class="text-dark">
                                        <td>response</td>
                                        <td>:</td>
                                        <td id="response"></td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>created_at</td>
                                        <td>:</td>
                                        <td>{{ $event->created_at }}</td>

                                    </tr>
                                    <tr class="text-dark">
                                        <td>updated_at</td>
                                        <td>:</td>
                                        <td>{{ $event->updated_at }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div hidden id="requestData">{{ $event->request }}</div>
                <div hidden id="responsetData">{{ $event->response }}</div>

            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <script>
        $(function() {

            var request = JSON.parse($('#requestData').text());

            $('#request').html('<pre>' + JSON.stringify(request, null, 2) + ' </pre>')

            var response = JSON.parse($('#responsetData').text());

            $('#response').html('<pre>' + JSON.stringify(response, null, 2) + ' </pre>')

        });
    </script>
</x-app-layout>
