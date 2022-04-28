<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Pago</h5>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <form id="payment_form" class="needs-validation" method="POST" action="">
                                @csrf
                                @method('PUT')
                                <h5 class="mt-1 mb-3 border-b-2">Métodos de pago</h5>
                                <hr>
                                <input type="hidden" name="payment_method" id="payment_method" value="">
                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
                                @if(Auth::user()->sales_limit > $order->total)
                                    @if($balance && $balance->balance > 0)
                                    <button id="cash" class="btn btn-primary" type="button" data-payment="Efectivo">Efectivo</button>
                                    @endif
                                    <button id="card" class="btn btn-primary" type="button" data-payment="Tarjeta">Tarjeta de crédito/débito</button>
                                @else
                                    <div class="alert-warning alert-dismissible fade show alert" role="alert">
                                        Lo sentimos, esta venta exede su limite establecido.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                @endif
                                <div id="cash_confirm" style="display: none;" class="row">
                                    <div class="col-12">
                                        <button class="btn-block btn-primary mt-5 mb-3 p-25" type="submit">Confirmar</button>
                                    </div>
                                </div>
                            </form>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#cash').on('click',function () {
                                        $('#cash_confirm').show('slow');
                                        $('#payment_method').val('Efectivo');
                                    });
                                    $('#card').on('click',function () {
                                        return false;
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
