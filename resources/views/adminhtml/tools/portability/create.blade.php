<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nueva solicitud</h5>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('portability.store') }}">
                                <div class="row">
                                    <x-form-input name="fullname" required="true" size="s">Nombre completo</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="email" required="true" size="s">Correo electrónico</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="nip" required="true" size="s">NIP</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="msisdn" required="true" size="s">Número telefonico a portar</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="msisdn_temp" required="true" size="s">Número telefonico temporal</x-form-input>
                                </div>
                                <div class="row">
                                    <x-form-input name="iccid" required="true" size="s">ICCID</x-form-input>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn  btn-primary" type="submit">Guardar</button>
                                        <a class="btn btn-light" href="{{ route('portability.index') }}">Cancelar</a>
                                    </div>
                                </div>

                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
</x-app-layout>
