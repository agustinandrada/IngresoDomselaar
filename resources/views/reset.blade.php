<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sistema de Control de Ingreso Domselaar</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <meta property="og:image" content="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}"
        media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}"
        media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Black-Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Clock-Real-Time-real-time-clock.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Clock-Real-Time.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dark-footer-with-social-media-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dark-NavBar-Navigation-with-Button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dark-NavBar-Navigation-with-Search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dark-NavBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-copyright_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Ludens-Users---2-Register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Manage-Users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar-Right-Links-Dark-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('css/simple-footer.css') }}">
</head>

<body>
    <section class="register-photo" style="background-color: transparent;padding-top: 0px;">
        <div class="form-container" style="margin-top: 40px;">
            <div class="image-holder"
                style="background: url({{ asset('img/login-estancias.jpg') }}) left / cover no-repeat;"></div>
            <form method="post" style="height: 525px;" action="{{ route('sendCode') }}">
                @csrf
                <h2 class="text-center" style="margin-top: 9px;">Recuperar Contraseña</h2>
                <div class="form-group mb-3"><input class="form-control" type="text" name="user"
                        placeholder="Usuario">
                    @error('user')
                        <div class="text-danger h6"><em>{{ $message }}</em></div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-primary d-block w-100" role="button" id="submitButton" type="submit"
                        style="color: rgb(255,255,255);background: #b19b76;">Enviar Código</button>
                </div>

                <p style="font-family: Montserrat, sans-serif;font-size: 11px;text-align: center;">
                    <img class="img-fluid" src="{{ asset('img/favicon.png') }}" style="width: 25px;">Desarrollo: <a
                        href="https://www.argdg.com" target="_blank">ArgDG.com</a>
                </p>
            </form>
        </div>
    </section>
</body>

</html>
