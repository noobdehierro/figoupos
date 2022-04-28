@props([
    'id' => '',
    'brand' => '',
    'action' => 'Ver/Editar',
    'action_route' => 'default',
    'qv_offering_id' => '',
])

@php
    if ($action_route === 'default') {
        $action_route = route('offerings.edit', $id);
    }
@endphp

<div class="col-md-3 col-xs-12">
    <div class="card offering-card">
        <div class="card-header">
            <h5>{{ $name }}</h5>
            <div class="offering-price">
                ${{ $price }} MXN
            </div>
            <div>{{ $brand }}</div>
        </div>
        <div class="card-body">
            <div class="offering-description">
                {{ $description }}
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ $action_route }}" data-id="{{ $qv_offering_id }}" class="btn shadow-1 btn-primary offering-select">{{ $action }}</a>
        </div>
    </div>
</div>
