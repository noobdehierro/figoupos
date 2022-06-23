<x-app-layout>
    @push('scripts')
        <script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
        <script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                OpenPay.setId("{{ $openpay['merchant_id'] }}");
                OpenPay.setApiKey("{{ $openpay['public_key'] }}");
                OpenPay.setSandboxMode({{ $openpay['is_sandbox'] }});
                //Se genera el id de dispositivo
                var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceSessionId");

                $('#pay-button').on('click', function(event) {
                    event.preventDefault();
                    $("#pay-button").prop( "disabled", true);
                    OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
                });

                var sucess_callbak = function(response) {
                    var token_id = response.data.id;
                    $('#cardToken').val(token_id);
                    $('#payment-form').submit();
                };

                var error_callbak = function(response) {
                    var desc = response.data.description != undefined ? response.data.description : response.message;
                    alert("ERROR [" + response.status + "] " + desc);
                    $("#pay-button").prop("disabled", false);
                };

            });
        </script>
    @endpush

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
                                <form id="payment-form" method="POST" action="{{ route('recharges.confirm', $order->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <h5 class="mt-1 mb-3 border-b-2">Métodos de pago</h5>
                                    <hr>
                                    <input type="hidden" name="cardToken" id="cardToken">
                                    <input type="hidden" name="payment_method" id="payment_method" value="">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="user_name" id="user_name" value="{{ auth()->user()->name }}">

                                    @if(auth()->user()->sales_limit > auth()->user()->account->amount + $order->total)
                                        @if($balance && $balance->balance > $order->total)
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
                                    <div id="openpay_credit_card" class="row mt-3" style="display: none;">
                                        <div class="col-12">
                                            <div class="bkng-tb-cntnt">
                                                <div class="pymnts">
                                                    <div class="pymnt-itm card active">
                                                        <h2>Tarjeta de crédito o débito</h2>
                                                        <div class="pymnt-cntnt">
                                                            <div class="card-expl">
                                                                <div class="credit"><h4>Tarjetas de crédito</h4></div>
                                                                <div class="debit"><h4>Tarjetas de débito</h4></div>
                                                            </div>
                                                            <div class="sctn-row">
                                                                <div class="sctn-col l">
                                                                    <label>Nombre del titular</label><input type="text" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name">
                                                                </div>
                                                                <div class="sctn-col">
                                                                    <label>Número de tarjeta</label><input type="text" class="card_number" autocomplete="off" data-openpay-card="card_number"></div>
                                                            </div>
                                                            <div class="sctn-row">
                                                                <div class="sctn-col l">
                                                                    <label>Fecha de expiración</label>
                                                                    <div class="sctn-col half l"><input type="text" class="exp month" placeholder="Mes" data-openpay-card="expiration_month"></div>
                                                                    <div class="sctn-col half l"><input type="text" class="exp year" placeholder="Año" data-openpay-card="expiration_year"></div>
                                                                </div>
                                                                <div class="sctn-col cvv"><label>Código de seguridad</label>
                                                                    <div class="sctn-col half l"><input type="text" class="card_cvv" placeholder="3 dígitos" autocomplete="off" data-openpay-card="cvv2"></div>
                                                                </div>
                                                            </div>
                                                            <div class="openpay"><div class="logo">Transacciones realizadas vía:</div>
                                                                <div class="shield">Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
                                                            </div>
                                                            <div class="sctn-row">
                                                                <a class="button rght" id="pay-button">Pagar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('#cash').on('click',function () {
                                            $('#openpay_credit_card').hide();
                                            $('#cash_confirm').show('slow');
                                            $('#payment_method').val('Efectivo');
                                        });
                                        $('#card').on('click',function () {
                                            $('#cash_confirm').hide();
                                            $('#openpay_credit_card').show('slow');
                                            $('#payment_method').val('Tarjeta de crédito');
                                        });

                                        $('.month').on('keyup', function () {
                                            if ($(this).val().length === 2){
                                                $('.year').focus();
                                            }
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
