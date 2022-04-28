@props([
    'name' => '',
    'checked' => '0',
    'switch' => [
        '0' => '',
        '1' => 'checked="checked"',
        'true' => 'checked="checked"'
    ]
])
<x-input-container size="s">
    <div class="switch switch-primary d-inline m-r-10">
        <input type="checkbox" id="{{ $name }}" name="{{ $name }}" {{ $attributes }} {{ $switch[$checked] }}>
        <label for="{{ $name }}" class="cr"></label>
    </div>
    <label>{{ $slot }}</label>
</x-input-container>
