<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Edición de usuario</h5>
            <form id="destroy-form" action="{{ route('users.destroy',$user->id) }}" method="POST" class="top-card-link">
                @csrf
                @method('DELETE')
                <x-confirm id="user-alert" action="Eliminar">
                    ¿Esta seguro de eliminar este usuario?
                </x-confirm>
            </form>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('users.update', $user->id) }}" method="PUT">
                                <div class="row">
                                    <x-form-input name="name" required="true" value="{{ $user->name }}" size="s">Nombre</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="email" required="true" type="email" value="{{ $user->email }}" :readonly="(Auth::user()->role_id === 1) ? 'false' : 'true'" size="s">Correo electrónico</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="sales_limit" type="number" value="{{ $user->sales_limit }}" size="s">Limite de venta</x-form-input>
                                </div>

                                @if( Auth::user()->role_id === 1)
                                    <div class="row">
                                        <x-form-select name="role_id" label="Rol" size="s">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ (old('role_id', $user->role_id)) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </x-form-select>
                                    </div>
                                    <div class="row">
                                        <x-form-select name="brand_id" label="Marca" size="s">
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ (old('brand_id', $user->brand_id)) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </x-form-select>
                                    </div>
                                @endif
                                <div class="row">
                                    <x-form-switch name="is_active" checked="{{ $user->is_active }}" size="s">Activo</x-form-switch>
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
