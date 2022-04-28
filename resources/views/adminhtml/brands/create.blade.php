<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nueva marca</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('brands.store') }}" enctype="multipart/form-data">
                                <div class="row">
                                    <x-form-input name="name" required="true" size="s">Nombre</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="description" size="s">Descripción</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-file name="logo" size="s">Logo</x-form-file>
                                </div>
                                <div class="row">
                                    <x-form-switch name="is_active" checked="true" size="s">Activo</x-form-switch>
                                </div>
                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-light" href="{{ route('brands.index') }}">Cancelar</a>
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
