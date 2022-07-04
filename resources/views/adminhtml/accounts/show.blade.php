<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Movimientos de la cuenta de:</h5>
            <a id="add" href="{{ route('accounts.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Corte de caja</span>
            </a>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Monto</th>
                                            <th>Descripción</th>
                                            <th>Operacion</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $movements as $movement)
                                        <tr>
                                            <td>{{ $movement->id }}</td>
                                            <td>{{ $movement->amount }}</td>
                                            <td>{{ $movement->description }}</td>
                                            <td>{{ $movement->operation }}</td>
                                            <td>{{ $movement->created_at }}</td>
                                        <tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
