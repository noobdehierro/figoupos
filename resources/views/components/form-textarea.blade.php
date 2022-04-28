@props([
    'name' => '',
    'label' => '',
    'size' => 'l'
])
<x-input-container size="{{ $size }}">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <textarea class="form-control" id="{{ $name }}" name="{{ $name }}" rows="3" spellcheck="false" {{ $attributes }}>{{ $slot  ?? old($name) }}</textarea>
    <x-form-error name="{{ $name }}" />
</x-input-container>
