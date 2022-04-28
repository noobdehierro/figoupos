<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <a id="add" href="{{ route('offerings.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Añadir oferta</span>
            </a>
        </div>
    </div>
    <div class="row">
        @foreach($offerings as $offering)
            <x-offering id="{{ $offering->id }}" brand="{{ $offering->brand->name }}">
                <x-slot name="name">{{ $offering->name }}</x-slot>
                <x-slot name="price">{{ $offering->price }}</x-slot>
                <x-slot name="description">
                    {!! $offering->description !!}
                </x-slot>
            </x-offering>
        @endforeach
    </div>
</x-app-layout>
