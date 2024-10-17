<nav class="navbar navbar-expand-md bg-dark py-3" data-bs-theme="dark">
    <div class="container-fluid"><a class="navbar-brand d-flex align-items-center" href="/estancias/dashboard"><img
                class="img-fluid" src="{{ asset('img/logo-estancias-sistema.png') }}" width="161"
                height="78"></a><button data-bs-toggle="collapse" class="navbar-toggler"
            data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-5">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('owner-list') }}"><i
                            class="fa fa-home"></i>&nbsp;Propietarios</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('authorized-list') }}"><i class="fa fa-users"
                            style="font-size: 17px;"></i>&nbsp;Autorizados</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('tenant-list') }}"><i
                            class="fa fa-handshake-o"></i>&nbsp;Inquilinos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('visitor-list') }}"><i
                            class="fa fa-car"></i>&nbsp;Visitas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('history') }}"><i
                            class="fa fa-id-card"></i>&nbsp;Historiasl de Registros</a></li>
                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false"
                        data-bs-toggle="dropdown" href="#"><i class="fa fa-gear"></i>&nbsp;Sistema</a>
                    <div class="dropdown-menu"><a class="dropdown-item"
                            href="/estancias/view-user/{{ session()->get('user')->id }}">Mis Datos</a><a
                            class="dropdown-item" href="/estancias/manage-users?f=0">Gestionar Usuarios</a><a
                            class="dropdown-item" href="/estancias/technical-support">Soporte Tecnico</a></div>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link" type="submit"><i class="fa fa-window-close"></i>&nbsp;Cerrar
                            Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
