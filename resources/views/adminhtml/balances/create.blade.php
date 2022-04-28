<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nuevo abono</h5>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('balances.store') }}">
                                <div class="row">
                                    <x-form-input type="number" name="amount" required="true" size="xs" group="$">Cantidad</x-form-input>
                                    <x-form-input name="description" required="true" size="m">Descripción</x-form-input>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="operation" value="Abono">
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn  btn-primary" type="submit">Guardar</button>
                                        <a class="btn btn-light" href="{{ route('balances.index') }}">Cancelar</a>
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
