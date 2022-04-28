@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'size' => 'l',
    'options' => [],
    'required' => '',
])

<x-input-container size="{{ $size }}">
        <label class="form-label" for="{{ $name }}">{{ $label }}@if($required != '')<span class="text-c-red">*</span>@endif</label>
        <select class="form-control"
                id="{{ $name }}"
                name="{{ $name }}" {{ $attributes }}
            @if($required != '')
                required
            @endif
        >
            <option value="">--Seleccione una opción--</option>
            @if ($options && count($options) > 0)
                @foreach($options as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </select>
        <x-form-error name="{{ $name }}" />
</x-input-container>
