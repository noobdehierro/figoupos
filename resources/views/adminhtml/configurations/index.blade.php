<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Configuraciones</h5>
            <a id="add" href="{{ route('configurations.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
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
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Código</th>
                                        <th>Valor</th>
                                        <th>Grupo</th>
                                        <th>Protegida</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$configurations->isEmpty())
                                        @foreach($configurations as $configuration)
                                            <tr>
                                                <td>{{ $configuration->id }}</td>
                                                <td>{{ $configuration->label }}</td>
                                                <td>{{ $configuration->code }}</td>
                                                <td>{{ $configuration->value }}</td>
                                                <td>{{ $configuration->group }}</td>
                                                <td>{{ $configuration->is_protected ? 'Si' : 'No' }}</td>
                                                <td>
                                                    <a href="{{ route('configurations.edit', $configuration->id) }}" class="btn btn-primary btn-sm">Ver/Editar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                <x-flash type="warning">No hay configuraciones</x-flash>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $configurations->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
