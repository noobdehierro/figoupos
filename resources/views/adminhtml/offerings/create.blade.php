<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Creación de oferta</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('offerings.store') }}">
                                <div class="row">
                                    <x-form-input name="name" required="true" size="s">Nombre</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-textarea name="description" required="true" label="Descripción" size="s"></x-form-textarea>
                                </div>
                                <div class="row">
                                    <x-form-input name="price" required="true" type="number" size="s">Precio</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="seller_price" required="true" type="number" size="s">Precio de Vendedor</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="qv_offering_id" required="true" small="Identificador relacionado a las ofertas de Qvantel" size="s">ID Qvantel</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="promotion" small="Utilizado para resaltar un texto al final de la oferta" size="s">Promoción</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-select name="brand_id" label="Marca" size="s">
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </x-form-select>
                                </div>
                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-light" href="{{ route('offerings.index') }}">Cancelar</a>
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
