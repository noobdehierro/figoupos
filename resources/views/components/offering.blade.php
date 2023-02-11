@props([
    'id' => '',
    'brand' => '',
    'action' => 'Ver/Editar',
    'action_route' => 'default',
    'qv_offering_id' => '',
])

@php
    $selectButton = true;
    if ($action_route === 'default') {
        $action_route = route('offerings.edit', $id);
        $selectButton = false;
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
        @if($seller_price ?? '')
        <div class="card-body">
            <div class="offering-sellerPrice">
               Precio Vendedor: ${{ $seller_price }}MXN
            </div>
        </div>
        @endif
        @if($selectButton)
            <div class="card-footer">
                <a href="{{ $action_route }}" data-id="{{ $qv_offering_id }}" class="btn shadow-1 btn-primary offering-select">{{ $action }}</a>
            </div>
        @else
            @super
            <div class="card-footer">
                <a href="{{ $action_route }}" data-id="{{ $qv_offering_id }}" class="btn shadow-1 btn-primary offering-select">{{ $action }}</a>
            </div>
            @endsuper
        @endif
    </div>
</div>

