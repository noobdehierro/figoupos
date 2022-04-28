<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Mi perfil</h5>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <form class="needs-validation" method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <x-form-input name="name" required="true" value="{{ $user->name }}">Nombre</x-form-input>
                                <x-form-input name="email" required="true" type="email" value="{{ $user->email }}" readonly="readonly">Correo electrónico</x-form-input>
                                <x-form-input name="password" type="password">Contraseña</x-form-input>
                                <x-form-input name="password_confirmation" type="password">Repetir contraseña</x-form-input>
                                <button class="btn  btn-primary" type="submit">Guardar</button>
                                <a class="btn btn-light" href="{{ route('dashboard') }}">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>

