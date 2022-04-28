<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Edición de marca</h5>
            <x-form action="{{ route('brands.destroy',$brand->id) }}" method="DELETE" class="top-card-link">
                <x-confirm id="brand-alert" action="Eliminar">¿Esta seguro de borrar esta marca?</x-confirm>
            </x-form>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('brands.update', $brand->id) }}" method="PUT" enctype="multipart/form-data">
                                <div class="row">
                                    <x-form-input name="name" value="{{ $brand->name }}" required="true" size="s">Nombre</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="description" value="{{ $brand->description }}" size="s">Descripción</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-file name="logo" size="s">Logo</x-form-file>
                                </div>
                                @if ($brand->logo)
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <img src="{{ Storage::url($brand->logo) }}" class="brand-logo" />
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <x-form-switch name="is_active" checked="{{ $brand->is_active }}" size="s">Activo</x-form-switch>
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
