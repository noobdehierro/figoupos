<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Recarga</h5>
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
                                        <a class="btn btn-primary" href="{{ route('recharges.payment', $order->id) }}">Continuar</a>
                                        <x-form action="{{ route('recharges.update',$order->id) }}" method="PATCH" style="display: inline-block">
                                            <x-confirm id="purchase-alert" action="Cancelar orden">¿Esta seguro de cancelar esta orden?</x-confirm>
                                        </x-form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-block">
                                <h5 class="mt-1 mb-3">Datos</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr class="text-dark">
                                        <td>MSISDN</td>
                                        <td>:</td>
                                        <td>{{ $order->msisdn }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Total</td>
                                        <td>:</td>
                                        <td>${{ $order->total }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>QV ID</td>
                                        <td>:</td>
                                        <td>{{ $order->qv_offering_id }}</td>
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
        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card user-list">
                            <div class="card-block pb-0">
                                <x-form action="{{ route('recharges.offerings') }}">
                                    <div class="row">
                                        <x-form-input name="msisdn" required="true" size="s" type="tel">Teléfono a recargar</x-form-input><br/>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn  btn-primary" type="submit">Siguiente</button>
                                        </div>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    @endif
</x-app-layout>
