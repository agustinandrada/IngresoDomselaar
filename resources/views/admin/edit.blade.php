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
    <div class="d-flex flex-column min-vh-100">
        @include('modules.nav')
        <div class="container-fluid">
            <div class="card shadow mb-3" style="margin-top: 35px;">
                <h1 style="font-size: 28px;margin-left: 23px;">Editar</h1>
                <div class="card-body">
                    <form method="POST" action="{{ route('update-user', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-bottom: 25px;text-align: left;">

                            <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 col-xxl-2"
                                style="display: inline;text-align: center;margin-bottom: 25px;">
                                <img id="profileImage" class="rounded-circle mb-3 mt-4 img-fluid"
                                    src="{{ asset($user->photo) === asset('/') ? asset('img/user.jpg') : asset($user->photo) }}"
                                    style="display: inline;max-height: 110px;">
                                <br>
                                <label for="photoInput" class="btn btn-primary btn-sm"
                                    style="background: #b19b76;border-width: 0px;">
                                    Cambiar Foto
                                </label>
                                <input type="file" id="photoInput" name="photo" style="display: none;"
                                    accept="image/*" onchange="onLoad(event)">
                            </div>

                            <div class="col-sm-8 col-md-8 col-lg-9 col-xl-10 col-xxl-10 align-self-center">
                                <div class="row">
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label"
                                                for="email"><strong>Email&nbsp;</strong></label><input
                                                class="form-control" type="email" id="email"
                                                value="{{ $user->email }}" placeholder="Ingresa tu email"
                                                name="email" required=""></div>
                                    </div>
                                    <div class="col-md-12 text-start">
                                        <div class="mb-3"><label class="form-label" for="username"><strong>Usuario
                                                    (el
                                                    usuario debe ser el DNI)</strong></label><input
                                                class="form-control" type="text"
                                                placeholder="Tu usuario es tu DNI" name="user"
                                                value="{{ $user->user }}" required=""></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3" style="border-style: none;"><label class="form-label"
                                        for="first_name"><strong>Nombre</strong></label><input class="form-control"
                                        type="text" name="name" required="" value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label"
                                        for="last_name"><strong>Apellido</strong></label><input class="form-control"
                                        type="text" name="last_name" required=""
                                        value="{{ $user->last_name }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label"
                                        for="phone"><strong>Telefono</strong></label><input class="form-control"
                                        type="number" name="phone" value="{{ $user->phone }}"></div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3"><label class="form-label"
                                        for="role"><strong>Rol</strong></label><select
                                        class="form-select states order-alpha" id="stateId" name="role"
                                        required="">
                                        <option value="0" @if ($user->role == '0') selected @endif>
                                            Usuario
                                        </option>
                                        <option value="1" @if ($user->role == '1') selected @endif>
                                            Administrador</option>
                                    </select></div>
                            </div>

                            <div class="col">
                                <p id="emailErrorMsg" class="text-danger" style="display:none;"></p>
                                <p id="passwordErrorMsg" class="text-danger" style="display:none;"></p>
                            </div>

                        </div>
                        <button class="btn btn-primary" type="submit" id="submitBtn" name="submitBtn"
                            value="submitBtn" style="background: rgb(177,155,118);">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('modules.footer')
    @include('layouts.bodyScripts')
</body>

</html>
