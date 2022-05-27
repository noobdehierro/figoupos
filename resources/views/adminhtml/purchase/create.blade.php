<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Registro de información</h5>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('purchase.store') }}">
                                <x-slot name="rules">
                                    {
                                        telephone: {minlength: 10},
                                        iccid: {minlength: 19},
                                        imei: {minlength: 15},
                                        postcode: {minlength: 5},
                                        nip: {minlength: 4},
                                        msisdn: {minlength: 10},
                                        msisdn_temp: {minlength: 10}
                                    }
                                </x-slot>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="mt-1 mb-3 border-b-2">Datos personales</h5>
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <x-form-input name="status" type="hidden" value="Pending"></x-form-input>
                                            <x-form-input name="sales_type" type="hidden" value="Contratación"></x-form-input>
                                            <x-form-input name="user_name" type="hidden" value="{{ auth()->user()->name }}"></x-form-input>
                                            <x-form-input name="qv_offering_id" type="hidden" value="{{ $offering->qv_offering_id }}"></x-form-input>
                                            <x-form-input name="brand_id" type="hidden" value="{{ auth()->user()->primary_brand_id }}"></x-form-input>
                                            <x-form-input name="brand_name" type="hidden" value="{{ $offering->brand->name }}"></x-form-input>
                                            <x-form-input name="total" type="hidden" value="{{ $offering->price }}"></x-form-input>
                                            <x-form-input name="channel" type="hidden" value="POS"></x-form-input>
                                            <x-form-input name="name" required="true" size="m">Nombre</x-form-input>
                                            <x-form-input name="lastname" required="true" size="m">Apellidos</x-form-input>
                                            <x-form-input name="email" required="true" type="email" size="s">Correo electrónico</x-form-input>
                                            <x-form-input name="telephone" required="true" size="s">Teléfono</x-form-input>
                                            <x-form-input name="birday" type="date" size="s">Fecha de nacimiento</x-form-input>
                                            <x-form-input name="iccid" required="true" type="tel" minlenght="15" size="m">ICCID</x-form-input>
                                            <x-form-input name="imei" size="m">IMEI</x-form-input>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="mt-1 mb-3">Dirección</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <x-form-input name="street" required="true" size="m">Calle</x-form-input>
                                            <x-form-input name="outdoor" required="true" size="xs">No. exterior</x-form-input>
                                            <x-form-input name="indoor" size="xs">No. interior</x-form-input>
                                            <x-form-input name="references" required="true" size="m">Referencias</x-form-input>
                                            <x-form-input name="postcode" required="true" size="xs">Código postal</x-form-input>
                                            <x-form-input name="suburb" required="true" size="xs">Colonia</x-form-input>
                                            <x-form-input name="city" required="true" size="xs">Municipio</x-form-input>
                                            <x-form-input name="region" required="true" size="xs">Estado</x-form-input>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="mt-1 mb-3">Portabilidad</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <x-form-switch name="portabilidad" checked="0">Requiere portabilidad</x-form-switch>

                                        <div id="pannel_portabilidad" class="pannel">
                                            <div class="row">
                                                <x-form-input name="nip" size="s">NIP</x-form-input>
                                                <x-form-input name="msisdn" required="true" size="s">Número a portar</x-form-input>
                                                <x-form-input name="msisdn_temp" required="true" size="s">Número temporal</x-form-input>
                                            </div>
                                        </div>
                                        <script>
                                            $(function () {
                                                $('#portabilidad').on('change', function () {
                                                    if ($('#portabilidad').prop('checked')) {
                                                        $('#pannel_portabilidad').show();
                                                    } else {
                                                        $('#pannel_portabilidad').hide();
                                                    }
                                                });
                                            });
                                        </script>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn  btn-primary" type="submit">Pagar</button>
                                        <a class="btn btn-light" href="{{ route('purchase.index') }}">Regresar</a>
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
</x-app-layout>
