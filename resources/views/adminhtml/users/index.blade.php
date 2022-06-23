<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Gestor de usuarios</h5>
            <a id="add" href="{{ route('users.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Añadir usuario</span>
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
                                        <th>@sortablelink('brand.name','marca')</th>
                                        <th>@sortablelink('name','nombre')</th>
                                        <th>@sortablelink('email','Correo electrónico')</th>
                                        <th>@sortablelink('role.name','rol')</th>
                                        <th>@sortablelink('sales_limit','Limite disponible')</th>
                                        <th>@sortablelink('created_at','fecha de creación')</th>
                                        <th>@sortablelink('is_active','Activo')</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        @if( $user->role_id == 1 && Auth::user()->role_id != 1)

                                        @else
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->brand->name }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td>${{ $user->sales_limit }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ $user->is_active ? 'Si' : 'No' }}</td>
                                                <td>
                                                    <a href="{{ route("users.edit", $user->id) }}" class="btn btn-primary btn-sm">Ver/Editar</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $users->appends(\Request::except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
