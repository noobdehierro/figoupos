<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Cuentas</h5>
            <a id="add" href="{{ route('accounts.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Añadir nueva</span>
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
                                            <th>@sortablelink('id','#')</th>
                                            <th>@sortablelink('user.name','usuario')</th>
                                            <th>@sortablelink('name','Nombre de la cuenta')</th>
                                            <th>@sortablelink('amount','Saldo disponible')</th>
                                            <th>@sortablelink('is_active','activo')</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($accounts as $account)
                                        <tr>
                                            <td>{{ $account->id }}</td>
                                            <td>{{ $account->user->name }}</td>
                                            <td>{{ $account->name }}</td>
                                            <td>${{ $account->amount }}</td>
                                            <td>{{ $account->is_active ? 'Si' : 'No' }}</td>
                                            <td>
                                                <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-primary btn-sm">Ver/Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $accounts->appends(\Request::except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
