<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Marcas</h5>
            <a id="add" href="{{ route('brands.create') }}" title="Add New" type="button" class="btn btn-primary top-card-link" data-ui-id="add-button">
                <span>Añadir nuevo</span>
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
                                            <th>@sortablelink('id', '#')</th>
                                            <th>@sortablelink('name', 'Nombre')</th>
                                            <th>@sortablelink('parent.name', 'Padre')</th>
                                            <th>@sortablelink('description', 'Descripción')</th>
                                            <th>Logo</th>
                                            <th>@sortablelink('is_active','activo')</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td>
                                                @if($brand->parent_id)
                                                    {{ $brand->parent->name }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>{{ $brand->description }}</td>
                                            <td>
                                                @if ($brand->logo)
                                                    <img src="{{ Storage::url($brand->logo) }}" class="brand-logo" />
                                                @endif
                                            </td>
                                            <td>{{ $brand->is_active ? 'Si' : 'No' }}</td>
                                            <td>
                                                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-primary btn-sm">Ver/Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {!! $brands->appends(\Request::except('page'))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
