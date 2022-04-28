@props([
    'name' => '',
    'value' => '',
    'type' => 'type="text"',
    'small' => '',
    'input_style' => 'structured',
    'readonly' => 'false',
    'size' => 'l',
    'required' => '',
    'group' => ''
])

@if ($type != 'hidden')
    <x-input-container size="{{ $size }}">
        <label class="form-label" for="{{ $name }}">{{ $slot }}@if($required != '')<span class="text-c-red">*</span>@endif</label>
        @if($group !== '')
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-text">{{ $group }}</span>
        @endif
        <input class="form-control"
               id="{{ $name }}"
               name="{{ $name }}" {{ ( $readonly === 'true' ) ? 'readonly' : '' }}
               value="{{ old($name, $value) }}" {{ $attributes->merge(['type' => $type]) }}
            @if($required != '')
               required
            @endif
        >
        @if($group !== '')
                </div>
            </div>
        @endif
        @if ($small != '')
            <small>{{ $small }}</small>
        @endif
        <x-form-error name="{{ $name }}" />
    </x-input-container>
@else
    <input class="form-control" id="{{ $name }}" name="{{ $name }}" value="{{ ($value != '') ? $value : old($name) }}" {{ $attributes->merge(['type' => $type]) }}>
@endif
