<x-app-layout>

    @push('meta')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush

    @push('scripts')
            <script type="text/javascript" src="https://pay.conekta.com/v1.0/js/conekta-checkout.min.js"></script>
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
                            <x-form id="payment_form" method="PUT" action="{{ route('purchase.confirm', $order->id) }}">
                                @csrf
                                @method('PUT')
                                <h5 class="mt-1 mb-3 border-b-2">Métodos de pago</h5>
                                <hr>
                                <input type="hidden" name="payment_method" id="payment_method" value="">
                                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="user_name" id="user_name" value="{{ auth()->user()->name }}">
                                @if(auth()->user()->sales_limit > auth()->user()->account->amount + $order->total)
                                    @if($balance && $balance->balance > $order->total)
                                    <button id="cash" class="btn btn-primary" type="button" data-payment="Efectivo">Efectivo</button>
                                    @endif
                                    <button id="card" class="btn btn-primary" type="button" data-payment="Tarjeta">Tarjeta de crédito/débito</button>
                                    <button id="seller_card" class="btn btn-primary" type="button" data-payment="Tarjeta_vendedor">Tarjeta de vendedor</button>
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
                                <div id="conekta_credit_card" class="row" style="display: none">
                                    <div class="col-md-6">
                                        @if(isset($conekta))

                                            <div id="conektaIframeContainer" style="height: 595px;"></div>
                                            <script type="text/javascript">
                                                window.ConektaCheckoutComponents.Card({
                                                    targetIFrame: "#conektaIframeContainer",
                                                    allowTokenization: true,
                                                    checkoutRequestId: "{{ $conekta['token'] }}",
                                                    publicKey: "{{ $conekta['public_key'] }}",
                                                    options: {
                                                        styles: {
                                                            inputType: 'basic',
                                                            buttonType: 'basic',
                                                            states: {
                                                                empty: {
                                                                    borderColor: '#FFAA00'
                                                                },
                                                                invalid: {
                                                                    borderColor: '#FF00E0'
                                                                },
                                                                valid: {
                                                                    borderColor: '#0079c1'
                                                                }
                                                            }
                                                        },
                                                        languaje: 'es',
                                                        button: {
                                                            colorText: '#ffffff',
                                                            backgroundColor: '#b187ff'
                                                        },
                                                        iframe: {
                                                            colorText: '#65A39B',
                                                            backgroundColor: '#FFFFFF'
                                                        }
                                                    },
                                                    onCreateTokenSucceeded: function(token) {
                                                        console.log(token)
                                                        $('#token').val(token.id);
                                                        $('#conekta_form').submit();
                                                    },
                                                    onCreateTokenError: function(error) {
                                                        $('#overlay').fadeIn();
                                                        console.log(error)
                                                        location.reload();
                                                    }
                                                })
                                            </script>
                                        @endif
                                    </div>
                                </div>
                            </x-form>
                            <x-form id="conekta_form" method="PUT" action="{{ route('purchase.conekta', $order->id) }}">
                                <x-form-input type="hidden" name="token" value=""></x-form-input>
                                <x-form-input type="hidden" name="card_payment_method" id="card_payment_method" value=""></x-form-input>
                            </x-form>
                            <script type="text/javascript">
                                $(document).ready(function () {

                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

                                    $('#cash').on('click',function () {
                                        $('#conekta_credit_card').hide();
                                        $('#cash_confirm').show('slow');
                                        $('#payment_method').val('Efectivo');
                                    });
                                    $('#card').on('click',function () {
                                        $('#cash_confirm').hide();
                                        $('#conekta_credit_card').show('slow');
                                        $('#card_payment_method').val('Tarjeta de crédito');
                                    });
                                    $('#seller_card').on('click',function () {
                                        $('#cash_confirm').hide();
                                        $('#conekta_credit_card').show('slow');
                                        $('#card_payment_method').val('Tarjeta_vendedor');
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
