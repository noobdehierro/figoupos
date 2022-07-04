<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Recarga</h5>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="pannel active" id="offering">
                <div class="row">
                    @if(isset($offerings) && count($offerings) > 0)
                        @foreach($offerings as $offering)
                            <x-offering id="{{ $offering->id }}" brand="" action="Seleccionar">
                                <x-slot name="name">{{ $offering->name }}</x-slot>
                                <x-slot name="price">{{ $offering->price }}</x-slot>
                                <x-slot name="description">
                                    {!! $offering->description !!}
                                </x-slot>
                                <x-slot name="action_route">#</x-slot>
                                <x-slot name="qv_offering_id">{{ $offering->qv_offering_id }}</x-slot>
                            </x-offering>
                        @endforeach
                            <x-form id="rechage_store" action="{{ route('recharges.store') }}" method="POST">
                                <x-form-input name="brand_id" type="hidden" value="{{ auth()->user()->primary_brand_id }}"></x-form-input>
                                <x-form-input name="brand_name" type="hidden" value="{{ auth()->user()->brand->name }}"></x-form-input>
                                <x-form-input name="qv_offering_id" type="hidden" value=""></x-form-input>
                                <x-form-input name="msisdn" type="hidden" value="{{ $msisdn }}"></x-form-input>
                                <x-form-input name="total" type="hidden" value=""></x-form-input>
                            </x-form>
                        <script>
                            $(function () {
                                $('.offering-select').on('click', function () {
                                    event.preventDefault();
                                    var card = $(this).closest('.offering-card')
                                    var price = card.find('.offering-price').text();
                                    price = Number(price.replace(' MXN', '').replace('$', '').trim());
                                    var qv_offering_id = $(this).data('id');

                                    $('#qv_offering_id').val(qv_offering_id);
                                    $('#total').val(price);

                                    $('#rechage_store').submit();
                                });
                            });
                        </script>
                    @else
                        <div class="col-12">
                            <x-flash type="warning" dismiss="yes">El número celular ingresado no esta registrado.</x-flash>
                        </div>
                    @endif
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
