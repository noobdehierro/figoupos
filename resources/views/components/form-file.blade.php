@props([
    'name',
    'size' => 'l'
])
<x-input-container size="{{ $size }}">
    <label class="form-label" for="{{ $name }}">{{ $slot }}</label>
    <input type="file" class="form-control" id="{{ $name }}" name="{{ $name }}" value="{{ old($name) }}" {{ $attributes }}>
    <x-form-error name="{{ $name }}" />
</x-input-container>
