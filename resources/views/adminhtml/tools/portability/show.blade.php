<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Detalle de la solicitud</h5>
            <a id="cancel" href="{{ route('portability.index') }}" title="Regresar" type="button" class="btn btn-secondary top-card-link">
                <span>Regresar</span>
            </a>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="mt-1 mb-3">Solicitud</h5>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="text-dark">
                                        <td>Nombre</td>
                                        <td>:</td>
                                        <td>{{ $portability->fullname }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Correo electrónico</td>
                                        <td>:</td>
                                        <td>{{ $portability->email }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td>{{ $portability->nip }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Teléfono a portar</td>
                                        <td>:</td>
                                        <td>{{ $portability->msisdn }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Número temporal</td>
                                        <td>:</td>
                                        <td>{{ $portability->msisdn_temp }}</td>
                                    </tr>
                                    <tr class="text-dark">
                                        <td>Fecha de solicitud</td>
                                        <td>:</td>
                                        <td>{{ $portability->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
