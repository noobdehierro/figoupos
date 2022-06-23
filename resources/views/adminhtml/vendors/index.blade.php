<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Vendedores</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form method='GET' action="{{ route('vendors.show') }}">
                                <div class="row">
                                    <x-form-input  name="initDate" type="date" size="s">Fecha inicio</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input  name="endDate" type="date" size="s">Fecha fin</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-select name="payment_method" label="Medio de pago" size="s">
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="null">Cancelado</option>

                                    </x-form-select>
                                </div>

                                <div class="row">
                                    <x-form-select name="sales_type" label="Tipo de orden" size="s">
                                        <option value="Contratación">Contratación</option>
                                        <option value="Recarga">Recarga</option>
                                    </x-form-select>
                                </div>

                                <div class="row">
                                    <x-form-select name="user_name" label="Vendedor" size="s">

                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                        @endforeach
                                    </x-form-select>
                                </div>

                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Generar reporte</button>
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
