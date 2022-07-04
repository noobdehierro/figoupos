<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Corte de caja</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                                    <div class="row">
                                        <x-form-select name="account_id" label="Usuario" size="s" required="true">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </x-form-select>
                                    </div>
                                <div class="row">
                                    <x-form-input name="amount" size="s">Monto</x-form-input>
                                </div>
                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-light" href="{{ route('accounts.index') }}">Cancelar</a>
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
