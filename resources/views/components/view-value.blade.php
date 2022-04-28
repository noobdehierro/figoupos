@props([
    'name' => '',
    'small' => '',
    'label' => '',
])

<div class="col-md-4 mb-3">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <div class="form-view" id="{{ $name }}"  {{ $attributes }}>
        {{ $slot }}
    </div>
    @if ($small != '')
        <small>{{ $small }}</small>
    @endif
</div>

