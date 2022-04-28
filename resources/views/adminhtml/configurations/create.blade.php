<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nueva configuración</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('configurations.store') }}">
                                <div class="row">
                                    <x-form-input name="label" required="true" size="s">Nombre</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="code" required="true" size="s">Código</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="value" required="true" size="s">Valor</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-select name="group" label="Grupo" required="true" size="s">
                                        <option value="Altan">Altan</option>
                                        <option value="General">General</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Qvantel">Qvantel</option>
                                    </x-form-select>
                                </div>
                                <div class="row">
                                    <x-form-switch name="is_protected">Protegida</x-form-switch>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn  btn-primary" type="submit">Guardar</button>
                                        <a class="btn btn-light" href="{{ route('configurations.index') }}">Cancelar</a>
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
