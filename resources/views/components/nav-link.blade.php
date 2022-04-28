@props(['route','icon','group'])

@php
    $active = explode('.', Route::currentRouteName())[0];
@endphp

<li class="nav-item {{ ($group == $active) ? 'active' : ''}}">
    <a href="{{ route($route) }}" {{ $attributes->merge(['class' => "nav-link "]) }}>
        <span class="pcoded-micon"><i class="feather icon-{{ $icon }}"></i></span><span class="pcoded-mtext">{{ $slot }}</span>
    </a>
</li>
