@props([
    'size' => 'l',
    'cols' => [
        'xs' => 'col-md-3 mb-3',
        's' => 'col-md-4 mb-3',
        'm' => 'col-md-6 mb-3',
        'l' => 'col-md-12 mb-3'
    ]
])

    <div class="{{ $cols[$size] }}">
        {{ $slot }}
    </div>
