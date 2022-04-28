<x-auth-layout>
    <div class="card-body text-center">
        <form id="password-recovery" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-4">
                <i class="feather icon-shield auth-icon"></i>
            </div>
            <h3 class="mb-4">Restablecer contraseña</h3>
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
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $request->email) }}"  required autofocus >
            </div>
            <div class="input-group mb-4">
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="input-group mb-4">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confrime contraseña" required>
            </div>
            <button class="btn btn-primary mb-4 shadow-2">Restablecer la contraseña</button>
        </form>
        <p class="mb-0 text-muted"> <a href="/">Acceder</a></p>
    </div>
    <script>
        $(function () {
            $("#password-recovery").validate( {
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: 'El campo email es requerido.',
                        email: 'Por favor, introduce una dirección de correo electrónico válida. Ej. usuario@dominio.com'
                    },
                    password: {
                        required: 'Una contraseña nueva es requerida.'
                    },
                    password_confirmation: {
                        required: 'Confirme la contraseña.'
                    }

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
