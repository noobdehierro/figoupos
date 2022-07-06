<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Corte de caja</h5>
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
                                            <th>Usuario</th>
                                            <th>Nombre de la cuenta</th>
                                            <th>Saldo disponible</th>
                                            <th>Activo</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($accounts as $account)
                                            <tr>
                                                <td>{{ $account->id }}</td>
                                                <td>{{ $account->user->name }}</td>
                                                <td>{{ $account->name }}</td>
                                                <td>${{ $account->amount }}</td>
                                                <td>{{ $account->is_active ? 'Si' : 'No' }}</td>
                                                <td>
                                                    <a href={{ route('cashClosings.show', $account->id) }}
                                                        class="btn btn-primary">Ver movimientos</a>
                                                    </a>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{-- {!! $accounts->links() !!} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
