<x-app-layout>
    <div class="card">
        <div class="card-header top-card">
            <h5>Nuevo Correo</h5>
            <x-form action="{{ route('mails.destroy',$mail->id) }}" method="DELETE" class="top-card-link">
                <x-confirm id="brand-alert" action="Eliminar">¿Esta seguro de borrar esta marca?</x-confirm>
            </x-form>
        </div>
    </div>


    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card user-list">
                        <div class="card-block pb-0">
                            <x-form action="{{ route('mails.update', $mail->id) }}"  method="PUT">
                                <div class="row">
                                    <x-form-input name="description" required="true" size="s" :value="old('description', $mail->description)">
                                        Descripción</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-select name="brand_id" label="Marca" size="s">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand_id', $mail->brand_id) == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}</option>
                                        @endforeach

                                    </x-form-select>
                                </div>

                                <div class="row">
                                    <x-form-input name="host" required="true" size="s" :value="old('host', $mail->host)">
                                        Host</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input name="port" required="true" size="s" :value="old('port', $mail->port)">
                                        Puerto</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input name="username" required="true" size="s" :value="old('username', $mail->username)">
                                        Usuario</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input type='password' name="password" required="true" size="s"
                                        :value="old('password', $mail->password)">
                                        Contraseña</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-select name="encryption" label="Encryption" size="s">
                                        <option value="tls"
                                            {{ old('encryption', $mail->encryption) == 'tls' ? 'selected' : '' }}>
                                            TLS</option>
                                        <option value="ssl"
                                            {{ old('encryption', $mail->encryption) == 'ssl' ? 'selected' : '' }}>
                                            SSL</option>
                                        <option value="none"
                                            {{ old('encryption', $mail->encryption) == 'none' ? 'selected' : '' }}>
                                            NONE</option>
                                    </x-form-select>
                                </div>

                                <div class="row">
                                    <x-form-input name="from_address" required="true" size="s" :value="old('from_address', $mail->from_address)">
                                        From Address</x-form-input>
                                </div>

                                <div class="row">
                                    <x-form-input name="from_name" required="true" size="s" :value="old('from_name', $mail->from_name)">
                                        From Name</x-form-input>
                                </div>

                                <div class="row">
                                    <button class="btn  btn-primary" type="submit">Guardar cambios</button>
                                    <a class="btn btn-light" href="{{ route('mails.index') }}">Cancelar</a>
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
