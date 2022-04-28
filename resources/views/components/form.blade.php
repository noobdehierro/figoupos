@props([
    'action' => '',
    'method' => 'POST',
    'rules' => '{}',
    'messages' => '{}'
])

<form @if($method != 'GET') method="POST" @else method="GET" @endif action="{{ $action }}" {{ $attributes->merge(['class' => " needs-validation"]) }}>
    @csrf
    @if($method != 'POST')
        @method( $method )
    @endif
    {{ $slot }}
</form>
<script>
    $(function () {
        $(".needs-validation").validate( {
            rules: {{ $rules }},
            messages: {{ $messages }},
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
