<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nuevo usuario</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('users.store') }}">
                                <x-slot name="rules">
                                    {
                                    password: {required:true, minlength: 8},
                                    password_confirmation: {required:true, minlength: 8, equalTo: '#password'}
                                    }
                                </x-slot>
                                <div class="row">
                                    <x-form-input name="name" required="true" size="s">Nombre</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="email" required="true" type="email" size="s">Correo electrónico</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="password" required="true" type="password" size="s">Contraseña</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="password_confirmation" required="true" type="password" size="s">Repetir contraseña</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-select name="role_id" label="Rol" required="true" size="s">
                                        @foreach($roles as $role)
                                            @if($role->id === 1)
                                                @if( Auth::user()->role_id === 1)
                                                    <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endif
                                            @else
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </x-form-select>
                                </div>
                                <div class="row">
                                    <x-form-input name="sales_limit" type="number" size="s" group="$">Limite de venta</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-select name="brand_id" label="Marca" size="s">
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </x-form-select>
                                </div>
                                @super
                                    <div class="row">
                                        <x-form-select name="primary_brand_id" label="Marca primaria" size="s">
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ old('primary_brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </x-form-select>
                                    </div>
                                @else
                                    <input type="hidden" name="primary_brand_id" value="{{ Auth::user()->primary_brand_id }}" />
                                @endsuper
                                <div class="row">
                                    <x-form-switch name="is_active" checked="true" size="s">Activo</x-form-switch>
                                </div>
                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-light" href="{{ route('users.index') }}">Cancelar</a>
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
