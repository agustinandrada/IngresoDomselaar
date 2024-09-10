<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sistema de Control de Ingreso Domselaar</title>
    <meta property="og:image" content="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238"
        href="{{ asset('img/fv.jpg" media="(prefers-color-scheme: dark)') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238"
        href="{{ asset('img/fv.jpg" media="(prefers-color-scheme: dark)') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Black-Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Clock-Real-Time-real-time-clock.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Clock-Real-Time.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dark-footer-with-social-media-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dark-NavBar-Navigation-with-Button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dark-NavBar-Navigation-with-Search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dark-NavBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-copyright_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Form.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="{{ asset('css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Ludens-Users---2-Register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Manage-Users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar-Right-Links-Dark-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('css/simple-footer.css') }}">
    <script src="{{ asset('js/profilePhoto.js') }}"></script>
</head>

<body>
    @include('modules.nav')
    <div class="container-fluid">
        <div class="card shadow mb-3" style="margin-top: 35px;">
            <div class="card-body">
                <div class="row" style="margin-bottom: 25px;text-align: left;">
                    <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2"
                        style="display: inline;text-align: center;margin-bottom: 25px;">
                        <img id="profileImage" class="rounded-circle mb-3 mt-4 img-fluid"
                            src="{{ asset($user->photo) === asset('/') ? asset('img/user.jpg') : asset($user->photo) }}"
                            style="display: inline;max-height: 110px;">
                        <br>
                    </div>

                    <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                        <div class="row">
                            <div class="col-md-12 text-start">
                                <div class="mb-3"><label class="form-label"
                                        for="email"><strong>Email&nbsp;</strong></label><input class="form-control"
                                        type="email" id="email" value="{{ $user->email }}"
                                        placeholder="Ingresa tu email" name="email" required="" disabled></div>
                            </div>
                            <div class="col-md-12 text-start">
                                <div class="mb-3"><label class="form-label" for="username"><strong>Usuario
                                        </strong></label><input class="form-control" type="text"
                                        placeholder="Tu usuario es tu DNI" name="user"
                                        value="{{ $user->user }}" required="" disabled></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3" style="border-style: none;"><label class="form-label"
                                for="first_name"><strong>Nombre</strong></label><input class="form-control"
                                type="text" name="name" required="" value="{{ $user->name }}" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3"><label class="form-label"
                                for="last_name"><strong>Apellido</strong></label><input class="form-control"
                                type="text" name="last_name" required="" value="{{ $user->last_name }}"
                                disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3"><label class="form-label"
                                for="phone"><strong>Telefono</strong></label><input class="form-control"
                                type="number" name="phone" value="{{ $user->phone }}" disabled></div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3"><label class="form-label"
                                for="role"><strong>Rol</strong></label><input class="form-control" type="text"
                                name="role" value="{{ $user->role === '1' ? 'Administrador' : 'Usuario' }}"
                                disabled>
                        </div>
                    </div>

                    <div class="col">
                        <p id="emailErrorMsg" class="text-danger" style="display:none;"></p>
                        <p id="passwordErrorMsg" class="text-danger" style="display:none;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bs-init.js') }}"></script>
    <script src="{{ asset('js/Clock-Real-Time-real-time-clock.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://geodata.solutions/includes/countrystate.js"></script>
    <script
        src="{{ asset('js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-F') }}ilters.js">
    </script>
    <script src="{{ asset('js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js') }}">
    </script>
</body>

</html>
