<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Edición de cuenta</h5>

        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('accounts.update', $account->id) }}" method="PUT">
                                <div class="container">
                                    @admin
                                        <div class="row">
                                            <x-form-select name="user_id" label="Usuario" size="s" required="true">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('user_id', $account->user_id) == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </x-form-select>
                                        @endadmin
                                        @super
                                            <x-form-select name="brand_id" label="Marca" size="s" required="true">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ old('brand_id', $account->brand_id) == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </x-form-select>
                                        </div>
                                    @else
                                        <input type="hidden" name="brand_id"
                                            value="{{ auth()->user()->primary_brand_id }}" />
                                    @endsuper
                                    <div class="row">
                                        <x-form-input name="name" size="s" required="true" :value="old('name', $account->name)">
                                            Nombre</x-form-input>
                                        <x-form-input name="amount" size="s" readonly="true" :value="old('amount', $account->amount)"
                                            group="$">Saldo disponible</x-form-input>
                                    </div>
                                    <div class="row">
                                        <x-form-switch name="is_active" checked="{{ $account->is_active }}"
                                            size="s">Activo</x-form-switch>
                                    </div>
                                    <div class="row">
                                        <button class="btn  btn-primary" type="submit">Guardar</button>
                                        <a class="btn btn-light" href="{{ route('accounts.index') }}">Cancelar</a>
                                    </div>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>@sortablelink('id', '#')</th>
                                            <th>@sortablelink('amount', 'Monto')</th>
                                            <th>@sortablelink('description', 'Descripción')</th>
                                            <th>@sortablelink('operation', 'Operación')</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($movements as $movement)
                                            <tr>
                                                <td>{{ $movement->id }}</td>
                                                <td>${{ $movement->amount }}</td>
                                                <td>{{ $movement->description }}</td>
                                                <td>{{ $movement->operation }}</td>
                                                <td>{{ $movement->created_at }}</td>
                                            <tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
