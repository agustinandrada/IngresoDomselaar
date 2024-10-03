<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    <div class="d-flex flex-column min-vh-100">
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
                            <p
                                style="font-family: Montserrat, sans-serif;font-size: 12px;color: var(--bs-emphasis-color);">
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
                                placeholder="Ingresar DNI o Nombre"><i class="fa fa-search"
                                style="margin-left: 4px;"></i>
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
                                        <td class="text-center align-middle" style="max-height: 60px;height: 60px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle" style="max-height: 60px;height: 60px;">
                                        </td>
                                    </tr>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modules.footer')
</body>

</html>
