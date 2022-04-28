<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Edición de configuración</h5>
            @if(!$configuration->is_protected)
                <x-form action="{{ route('configurations.destroy',$configuration->id) }}" method="DELETE" class="top-card-link">
                    <x-confirm id="configuration-alert" action="Eliminar">¿Esta seguro de borrar esta configuración?</x-confirm>
                </x-form>
            @endif
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('configurations.update', $configuration->id) }}" method="PUT">
                                <div class="row">
                                    <x-form-input name="label" value="{{ $configuration->label }}" required="true" size="s">Nombre</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="code" value="{{ $configuration->code }}" required="true" size="s" readonly="true">Código</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="value" value="{{ $configuration->value }}" required="true" size="s">Valor</x-form-input>
                                </div>
                                <div class="row">
                                    @if($configuration->is_protected)
                                        <x-form-input name="group" value="{{ $configuration->group }}" required="true" size="s" readonly="true">Grupo</x-form-input>
                                    @else
                                        <x-form-select name="group" label="Grupo" required="true" size="s">
                                            <option value="Altan" {{ (old('role_id', $configuration->group)) == 'Altan' ? 'selected' : '' }}>Altan</option>
                                            <option value="General" {{ (old('role_id', $configuration->group)) == 'General' ? 'selected' : '' }}>General</option>
                                            <option value="Payment" {{ (old('role_id', $configuration->group)) == 'Payment' ? 'selected' : '' }}>Payment</option>
                                            <option value="Qvantel" {{ (old('role_id', $configuration->group)) == 'Qvantel' ? 'selected' : '' }}>Qvantel</option>
                                        </x-form-select>
                                    @endif
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
