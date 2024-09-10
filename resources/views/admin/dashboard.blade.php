<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sistema de Control de Ingreso Domselaar</title>
    <meta property="og:image" content="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}"
        media="(prefers-color-scheme:
        dark)">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="238x238" href="{{ asset('img/fv.jpg') }}"
        media="(prefers-color-scheme:
        dark)">
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
</head>

<body>
    @include('modules.nav')
    <div class="container-fluid" style="margin-top: 22px;height: 474.1px;">
        <div class="card" id="TableSorterCard" style="margin-top: 19px;">
            <div class="card-header py-3">
                <div class="row table-topper align-items-center">
                    <div class="col-12 col-sm-5 col-md-6 text-start" style="margin: 0px;padding: 5px 15px;">
                        <p
                            style="font-family: Montserrat, sans-serif;font-size: 17px;margin-bottom: -4px;font-weight: bold;">
                            Registros
                            del Día</p>
                        <p style="font-family: Montserrat, sans-serif;font-size: 12px;color: var(--bs-emphasis-color);">
                            Los
                            registros del día se mantienen de 0 a 24 Hs.</p>
                    </div>
                    <div class="col-12 col-sm-7 col-md-6 text-end" style="margin: 0px;padding: 5px 15px;"><select
                            style="font-family: Montserrat, sans-serif;font-size: 14px;color: var(--bs-emphasis-color);">
                            <option value="14" selected>Todos</option>
                            <option value="12">Propietarios</option>
                            <option value>Autorizados</option>
                            <option value="13">Visitas</option>
                            <option value>Inquilinos</option>
                        </select><input class="form-control-sm" type="text"
                            style="margin-left: 10px;border-radius: 0;border-width: 1px;width: 250px;"
                            placeholder="Ingresar DNI o Nombre"><i class="fa fa-search" style="margin-left: 4px;"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="height: 238.594px;">
                    <div class="table-responsive" style="height: 251.6px;">
                        <table class="table table-striped table tablesorter" id="ipi-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">Fecha</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">hora</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">Lote</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">Nombre</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">apellido</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">vehículo</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">patente</th>
                                    <th class="text-center filter-false sorter-false"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">REGISTRO</th>
                                    <th class="text-center filter-false sorter-false"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">REGISTRO</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        10/05/2024</td>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        13:52</td>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        M45</td>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        Sergio</td>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        Gonzalez</td>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        Fiat
                                        Chronos</td>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        AC254FC</td>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        INGRESO</td>
                                    <td
                                        style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        <a href="ficha-propietario.html">PROPIETARIO</a>
                                    </td>
                                    <td class="text-center align-middle" style="max-height: 60px;height: 60px;"></td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle" style="max-height: 60px;height: 60px;"></td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-2" style="background: var(--bs-emphasis-color);">
        <div class="container">
            <div class="row">
                <div class="col-8 col-sm-6 col-md-6">
                    <p class="text-start"
                        style="margin-top: 5%;margin-bottom: 3%;font-family: Montserrat, sans-serif;font-size: 14px;color: var(--bs-body-bg);">
                        ©
                        2024 - ArgDG.com | Sistema de Control de Ingreso</p>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <p class="text-end"
                        style="margin-top: 5%;margin-bottom: 8%%;font-size: 1em;font-family: Montserrat, sans-serif;color: var(--bs-body-bg);">
                        <a href="mailto:soporte@argdg.com" style="color: var(--bs-body-bg);font-size: 14px;">Soporte
                            Tecnico</a>
                    </p>
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
        src="{{ asset('js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js') }}">
    </script>
    <script src="{{ asset('js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js') }}">
    </script>
</body>

</html>
