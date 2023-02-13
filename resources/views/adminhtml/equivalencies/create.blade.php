<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nueva equivalencia</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('equivalencies.store') }}" enctype="multipart/form-data">
                                <div class="row">
                                    <x-form-input name="qv_offering_id" required="true" size="s">qv_offering_id</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="altan_offering_id" required="true" size="s">altan_offering_id</x-form-input>
                                </div>
                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-light" href="{{ route('equivalencies.index') }}">Cancelar</a>
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
