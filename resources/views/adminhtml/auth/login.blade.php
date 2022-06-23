<x-auth-layout>
    <div class="card-body text-center">
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <img class="login-logo" src="{{ asset('adminhtml/images/igoutelecom.png') }}" alt="logo.png" />
            </div>
            <h3 class="mb-4"><i class="feather icon-unlock auth-icon"></i> Acceso </h3>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
                    <ul class="mt-0 mb-0 pl-0 list-unstyled text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
            @endif
            <div class="input-group mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" value="{{ old('email') }}" autofocus>
            </div>
            <div class="input-group mb-4">
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
            </div>
            <div class="form-group text-left">
                <div class="checkbox checkbox-fill d-inline">
                    <input type="checkbox" name="remember" id="remember" checked>
                    <label for="remember" class="cr"> {{ __('Recuerdame') }}</label>
                </div>
            </div>
            <button class="btn btn-primary shadow-2 mb-4">{{ __('Entrar') }}</button>
            @if (Route::has('password.request'))
                <p class="mb-2 text-muted">¿Olvidó la contraseña? <a href="{{ route('password.request') }}">{{ __('Reiniciar') }}</a></p>
            @endif
        </form>
    </div>
    <script>
        $(function () {
            $("#login-form").validate( {
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: 'required'
                },
                messages: {
                    email: {
                        required: 'El campo email es requerido.',
                        email: 'Por favor, introduce una dirección de correo electrónico válida. Ej. usuario@dominio.com'
                    },
                    password: 'El campo password es requerido.'
                },
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".input-group" ).addClass( "has-success" ).removeClass( "has-error" );
                }
            });

        });
    </script>
</x-auth-layout>



