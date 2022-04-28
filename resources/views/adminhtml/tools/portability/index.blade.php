<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Solicitudes de portabilidad</h5>
            <a id="add" href="{{ route('portability.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Nueva solicitud</span>
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
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Número a portar</th>
                                        <th>Fecha</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($portabilities as $portability)
                                        <tr>
                                            <td>{{ $portability->id }}</td>
                                            <td>{{ $portability->fullname }}</td>
                                            <td>{{ $portability->email }}</td>
                                            <td>{{ $portability->msisdn }}</td>
                                            <td>{{ $portability->created_at }}</td>
                                            <td>
                                                <a href="{{ route('portability.show', $portability->id) }}" class="btn btn-primary btn-sm">Ver/Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $portabilities->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
