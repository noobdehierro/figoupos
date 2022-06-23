<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Movimientos</h5>
            @if( Auth::user()->role_id === 1)
            <a id="add" href="{{ route('balances.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Abonar</span>
            </a>
            @endif
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-c-purple">Disponible: <span class="font-weight-bold"> ${{ $current }} MXN</span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@sortablelink('id','#')</th>
                                        <th>@sortablelink('brand.name','marca')</th>
                                        <th>@sortablelink('operation','tipo de operación')</th>
                                        <th>@sortablelink('user_name','usuario')</th>
                                        <th>@sortablelink('description','descripción')</th>
                                        <th>@sortablelink('amount','monto')</th>
                                        <th>@sortablelink('balance','saldo total')</th>
                                        <th>@sortablelink('created_at','fecha')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($balances as $balance)
                                        <tr>
                                            <td>{{ $balance->id }}</td>
                                            <td>{{ $balance->brand->name }}</td>
                                            <td>{{ $balance->operation }}</td>
                                            <td>{{ $balance->user_name }}</td>
                                            <td>{{ $balance->description }}</td>
                                            <td>{{ $balance->amount }}</td>
                                            <td><span class="f-w-700">${{ $balance->balance }}</span></td>
                                            <td>{{ $balance->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $balances->appends(\Request::except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
