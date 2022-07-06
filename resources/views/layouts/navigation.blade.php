<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="/dashboard" class="b-brand">
                <img class="login-logo" src="{{ asset('adminhtml/images/igoutelecom-color.png') }}" alt="logo.png" />
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                @seller

                <li class="nav-item pcoded-menu-caption">
                    <label>General</label>
                </li>

                <x-nav-link route="dashboard" icon="home" group="dashboard">Dashboard</x-nav-link>
                <x-nav-link route="purchase.index" icon="edit" group="purchase">Contratación</x-nav-link>
                <x-nav-link route="recharges.index" icon="battery-charging" group="recharges">Recarga</x-nav-link>

                @endseller

                <li class="nav-item pcoded-menu-caption">
                    <label>Herramientas</label>
                </li>

                <x-nav-link route="compatibility.index" icon="box" group="compatibility">Compatibilidad</x-nav-link>
                <x-nav-link route="portability.index" icon="phone-outgoing" group="portability">Portabilidad</x-nav-link>
                <x-nav-link route="coverage.index" icon="map-pin" group="coverage">Cobertura</x-nav-link>

                @seller

                <li class="nav-item pcoded-menu-caption">
                    <label>Ventas</label>
                </li>

                <x-nav-link route="orders.index" icon="credit-card" group="orders">Ordenes</x-nav-link>

                @endseller

                @admin
                    <li class="nav-item pcoded-menu-caption">
                        <label>Reportes</label>
                    </li>

                    <x-nav-link route="sales.index" icon="trending-up" group="sales">Ventas</x-nav-link>
                    <x-nav-link route="vendors.index" icon="user-check" group="vendors">Vendedores</x-nav-link>

                    <li class="nav-item pcoded-menu-caption">
                        <label>Catálogo</label>
                    </li>
                @endadmin

                @seller

                <x-nav-link route="offerings.index" icon="grid" group="offerings">Ofertas</x-nav-link>

                @endseller

                @distr
                    <li class="nav-item pcoded-menu-caption">
                        <label>Administración</label>
                    </li>

                    <x-nav-link route="users.index" icon="users" group="users">Usuarios</x-nav-link>
                    @admin
                        <x-nav-link route="balances.index" icon="sliders" group="balances">Saldo</x-nav-link>
                        <x-nav-link route="accounts.index" icon="briefcase" group="accounts">Cuentas</x-nav-link>
                        <x-nav-link route="brands.index" icon="tag" group="brands">Marcas</x-nav-link>
                        <x-nav-link route="cashClosings.index" icon="star-on" group="cashClosings">Corte de caja</x-nav-link>
                        <x-nav-link route="mails.index" icon="mail" group="mails">Correos</x-nav-link>

                    @endadmin

                    @super
                        <li class="nav-item pcoded-menu-caption">
                            <label>Sistema</label>
                        </li>

                        <x-nav-link route="configurations.index" icon="settings" group="configurations">Configuración</x-nav-link>
                        <x-nav-link route="configurations.index" icon="cloud" group="api">API</x-nav-link>
                    @endsuper
                @enddistr
            </ul>
        </div>
    </div>
</nav>
