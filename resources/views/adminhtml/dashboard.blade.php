<x-app-layout>
    <!-- [ breadcrumb ] start -->

    <!-- [ breadcrumb ] end -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->

            <!-- Accesos directos -->
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('purchase.index') }}">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h3 class="text-white text-center">Planes</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('recharges.index') }}">
                        <div class="card text-white bg-secondary ">
                            <div class="card-body">
                                <h3 class="text-white text-center">Recargas</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Fin accesos directos -->

            <!-- Ordenes recientes -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card user-list" style="height: auto;">
                        <div class="card-header">
                            <h5>Ordenes recientes</h5>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(54px, 41px, 0px);">
                                        <li class="dropdown-item full-card"><a href="#!"><span style=""><i class="feather icon-maximize"></i> maximize</span><span style="display: none;"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                        <li class="dropdown-item minimize-card"><a href="#!"><span style=""><i class="feather icon-minus"></i> collapse</span><span style="display: none;"><i class="feather icon-plus"></i> expand</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-block pb-0" style="">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Método de pago</th>
                                        <th>Estatus</th>
                                        <th>Fecha</th>
                                        <th>Acción</th>
                                    </tr></thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <h6 class="mb-1">{{ $order->name . ' ' . $order->lastname }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-1">{{ $order->sales_type }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-1">{{ $order->payment_method }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="m-0 @if ($order->status == 'Complete')text-c-green @elseif($order->status == 'Canceled') text-c-red @else text-c-yellow @endif">{{ $order->status }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="m-0">{{ $order->created_at }}</h6>
                                            </td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}" class="">Ver</a>
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
            <!-- Fin ordenes recientes -->

            @admin
            <!-- Graficos -->
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card Online-Order">
                        <div class="card-block">
                            <h5>Completadas</h5>
                            <h6 class="text-muted d-flex align-items-center justify-content-between m-t-30">Pago aceptado<span class="float-end f-18 text-c-green">{{ $complete }} / {{ $total }}</span></h6>
                            <div class="progress mt-3">
                                <div class="progress-bar progress-c-green" role="progressbar" style="
                                @if($total != 0)
                                    width:{{ number_format(($complete / $total) * 100, 2 ) }}%;
                                @else
                                    width: 0;
                                @endif
                                    height:6px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="text-muted mt-2 d-block">
                                @if($total != 0)
                                    {{ number_format(($complete / $total) * 100, 2 ) }}% Listo
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card Online-Order">
                        <div class="card-block">
                            <h5>Pendientes</h5>
                            <h6 class="text-muted d-flex align-items-center justify-content-between m-t-30">Pago pendiente<span class="float-end f-18 text-c-purple">{{ $pending }} / {{ $total }}</span></h6>
                            <div class="progress mt-3">
                                <div class="progress-bar progress-c-yellow" role="progressbar" style="
                                    @if($total != 0)
                                        width:{{ number_format(($pending / $total) * 100, 2 ) }}%;
                                    @else
                                        width: 0;
                                    @endif
                                    height:6px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="text-muted mt-2 d-block">
                                 @if($total != 0)
                                    {{ number_format(($pending / $total) * 100, 2 ) }}% Pendiente
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4">
                    <div class="card Online-Order">
                        <div class="card-block">
                            <h5>Canceladas</h5>
                            <h6 class="text-muted d-flex align-items-center justify-content-between m-t-30">Rechazadas<span class="float-end f-18 text-c-blue">{{ $candeled }} / {{ $total }}</span></h6>
                            <div class="progress mt-3">
                                <div class="progress-bar progress-c-red" role="progressbar" style="
                                    @if($total != 0)
                                        width:{{ number_format(($candeled / $total) * 100, 2 ) }}%;
                                    @else
                                        width: 0;
                                    @endif
                                    height:6px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="text-muted mt-2 d-block">
                                 @if($total != 0)
                                    {{ number_format(($candeled / $total) * 100, 2 ) }}% Cancelado</span>
                                @endif
                        </div>
                    </div>
                </div>

            </div>
            <!-- Fin graficos -->
            @endadmin

            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
