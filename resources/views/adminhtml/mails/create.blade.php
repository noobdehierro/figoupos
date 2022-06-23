<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nuevo Correo</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('mails.store') }}">
                                <div class="row">
                                    <x-form-input name="description" required="true" size="s">Descripcion</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-select name="brand_id" label="Marca" size="s">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </x-form-select>
                                </div>

                                <div class="row">
                                    <x-form-input name="host" required="true" size="s">Host</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input name="port" required="true" size="s">Port</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input name="username" required="true" size="s">Username</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input type='password' name="password" required="true" size="s">Password</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-select name="encryption" label="Encryption" size="s">
                                        <option value="ssl" {{ old('encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                        <option value="tls" {{ old('encryption') == 'tls' ? 'selected' : '' }}>TLS</option>
                                        <option value="none" {{ old('encryption') == 'none' ? 'selected' : '' }}>NONE</option>}
                                    </x-form-select>
                                </div>

                                <div class="row">
                                    <x-form-input name="from_address" required="true" size="s">From address</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input name="from_name" required="true" size="s">From name</x-form-input>
                                </div>

                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-light" href="{{ route('mails.index') }}">Cancelar</a>
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
