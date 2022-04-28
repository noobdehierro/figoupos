<x-app-layout>
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-1 mb-3">Compatible:
                                @if($device->deviceFeatures->band28 === 'SI')
                                    <span class="text-c-green font-weight-bold"> Compatible</span>
                                @else
                                    <span class="text-c-red font-weight-bold"> NO Compatible</span>
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="mt-1 mb-3">Dispositivo</h5>
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="text-dark">
                                    <td>MSISDN</td>
                                    <td>:</td>
                                    <td>{{ $device->msisdn }}</td>
                                </tr>
                                <tr class="text-dark">
                                    <td>Marca</td>
                                    <td>:</td>
                                    <td>{{ $device->brand }}</td>
                                </tr>
                                <tr class="text-dark">
                                    <td>Modelo</td>
                                    <td>:</td>
                                    <td>{{ $device->model }}</td>
                                </tr>
                                <tr class="text-dark">
                                    <td>Sistema operativo</td>
                                    <td>:</td>
                                    <td>{{ $device->deviceFeatures->os }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-block">
                            <h5 class="mt-1 mb-3">Estado y banda</h5>
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="text-dark">
                                    <td>IMEI</td>
                                    <td>:</td>
                                    <td>{{ $device->imei->imei }}</td>
                                </tr>
                                <tr class="text-dark">
                                    <td>Estatus</td>
                                    <td>:</td>
                                    <td>{{ $device->imei->status }}</td>
                                </tr>
                                <tr class="text-dark">
                                    <td>Homologación</td>
                                    <td>:</td>
                                    <td>{{ $device->imei->homologated }}</td>
                                </tr>
                                <tr class="text-dark">
                                    <td>Banda 28</td>
                                    <td>:</td>
                                    <td>{{ $device->deviceFeatures->band28 }}</td>
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
