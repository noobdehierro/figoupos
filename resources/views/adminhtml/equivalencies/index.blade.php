<x-app-layout>
    @super
    <div class="card">
        <div class="card-header top-card">
            <h5>Equivalencias</h5>
            <a id="add" href="{{ route('equivalencies.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Añadir nuevo</span>
            </a>
        </div>
    </div>
    @endsuper
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
                                            <th>@sortablelink('id', '#')</th>
                                            <th>@sortablelink('qv_offering_id', 'qv_offering_id')</th>
                                            <th>@sortablelink('altan_offering_id', 'altan_offering_id')</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($equivalencies as $equivalency)
                                        <tr>
                                            <td>{{ $equivalency->id }}</td>
                                            <td>{{ $equivalency->qv_offering_id }}</td>
                                            <td>{{ $equivalency->altan_offering_id }}</td>
                                            <td>
                                                <a href="{{ route('equivalencies.edit', $equivalency->id) }}" class="btn btn-primary btn-sm">Ver/Editar</a>
                                            </td>
                                        </tr>
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
