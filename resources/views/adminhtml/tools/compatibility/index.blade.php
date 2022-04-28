<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Compatibilidad</h5>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('compatibility.check') }}">
                                <div class="row">
                                    <div class="col-12">
                                        <p>Ingresa el código IMEI del teléfono celular para revisar la compatibilidad con la red 4.5G</p>
                                        <x-flash type="info" dismiss="yes">
                                            <p class="font-weight-bold">Hay tres maneras de obtenerlo</p>
                                            <ul>
                                                <li>Marca *#06# desde el teléfono celular a revisar.</li>
                                                <li>Búscalo en la configuración del teléfono celular, son entre 15 y 17 números</li>
                                                <li>Encuéntralo impreso en la etiqueta de la batería del teléfono celular</li>
                                            </ul>
                                        </x-flash>
                                    </div>
                                    <x-form-input name="imei" required="true" size="s" type="tel">IMEI</x-form-input><br/>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn  btn-primary" type="submit">Verificar</button>
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
