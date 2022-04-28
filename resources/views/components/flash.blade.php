@props([
    'type' => 'success',
    'dismiss' => 'yes',
    'colors' => [
        'success' => 'alert-success',
        'error' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-primary'
    ],
    'acctions' => [
        'yes' => 'alert-dismissible fade show',
        'no' => ''
    ]
])

<div {{ $attributes->merge(['class' => "$colors[$type] $acctions[$dismiss] alert"]) }} role="alert">
    {{ $slot }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="{{ $dismiss != 'yes' ? 'display:none;' : 'display:block;' }}"><span aria-hidden="true">×</span></button>
</div>
