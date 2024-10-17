<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    @include('modules.nav')
    @if ($eliminados > 0 || $visitas > 0 || $pendientes > 0)
        <script>
            // Asignar las variables directamente a JavaScript
            var eliminados = {!! json_encode($eliminados) !!};
            var visitas = {!! json_encode($visitas) !!};
            var pendientes = {!! json_encode($pendientes) !!};
            var cantidadPendientes = pendientes.length;
            var lotesPendientes = pendientes.map(function(e) {
                return e.lot;
            })

            // Ejecutar SweetAlert con los valores pasados desde PHP
            Swal.fire({
                title: "<strong>Datos Eliminados el día de hoy</strong>",
                icon: "info",
                html: `<strong>${eliminados}</strong> inquilinos han sido eliminados por vencimiento de contrato.<br/><br/>
                   <strong>${visitas}</strong> visitas han sido eliminadas.<br>
                   Quedan <strong>${cantidadPendientes}</strong> visitas pendientes de salir.<br>
                   Lotes con visitas pendientes: <strong>${lotesPendientes}</strong>`,
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: `
                <i class="fa fa-thumbs-up"></i>
            `,
                confirmButtonAriaLabel: "Thumbs up, great!",
                confirmButtonColor: "rgb(177,155,118)",
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session()->get('error') }}',
            })
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session()->get('success') }}',
            })
        </script>
    @endif
    <div class="d-flex flex-column min-vh-100 p-1">
        <div class="container-fluid">
            <div class="row" style="background: #b19b76;">
                <div class="col-md-10 offset-md-1">
                    <div class="card m-auto">
                        <div class="card-body" style="background: #b19b76;">
                            <p
                                style="color: var(--bs-emphasis-color);font-family: Montserrat, sans-serif;font-weight: bold;font-size: 14px;margin-bottom: 4px;">
                                Por favor coloque el DNI o Lote para verificar si la persona está autorizada e
                                ingresar.</p>
                            <form class="d-flex align-items-center" method="POST" action="{{ route('entry-search') }}">
                                @csrf
                                <input class="form-control form-control-sm flex-shrink-1 form-control-borderless"
                                    type="search"
                                    placeholder="Por Favor no dejar espacios antes y depues del dato ingresado"
                                    name="dni">
                                <button class="btn btn-success" type="submit"
                                    style="margin-bottom: 0px;">Registro</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="height: 100%;">
            <div class="card-header py-3">
                <div class="row table-topper align-items-center">
                    <div class="col-12 col-sm-5 col-md-6 col-xl-9 text-start" style="margin: 0px;padding: 5px 15px;">
                        <p
                            style="font-family: Montserrat, sans-serif;font-size: 17px;margin-bottom: -4px;font-weight: bold;">
                            Registros del Día</p>
                        <p style="font-family: Montserrat, sans-serif;font-size: 12px;color: var(--bs-emphasis-color);">
                            Los registros del día se mantienen de 0 a 24 Hs.</p>
                    </div>
                    <div class="col-12 col-sm-7 col-md-6 col-lg-2 col-xl-3 text-end"
                        style="margin: 0px;padding: 0px 15px;padding-right: 0px;padding-left: 0px;">
                        <select id="filterSelect" class="form-select-sm"
                            style="font-family: Montserrat, sans-serif;font-size: 14px;color: var(--bs-emphasis-color);width: 100%;">
                            <option value="0" selected="">Todos</option>
                            <option value="Propietario">Propietarios</option>
                            <option value="Autorizado">Autorizados</option>
                            <option value="Visita">Visitas</option>
                            <option value="Inquilino">Inquilinos</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped tablesorter" style="width: 100%; overflow-x: auto"
                            id="ipi-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">
                                        REGISTRO</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">
                                        FECHA</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">
                                        HORA</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">
                                        LOTE</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">
                                        CATEGORÍA
                                    </th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">
                                        NOMBRE</th>
                                    <th class="text-center"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">
                                        APELLIDO</th>
                                    <th class="text-center filter-false sorter-false"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">VEHÍCULO</th>
                                    <th class="text-center filter-false sorter-false"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">PATENTE</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($data as $value)
                                    <?php
                                    $url = match ($value->type) {
                                        'Propietario' => '/estancias/view-owner/' . $value->id,
                                        'Autorizado' => '/estancia/view-authorized/' . $value->id,
                                        'Visita' => '/estancia/view-visitor/' . $value->id,
                                        'Inquilino' => '/estancia/view-tenant/' . $value->id,
                                    };
                                    ?>
                                    <tr data-category="{{ $value->type }}"
                                        onclick="window.location='{{ $url }}'" style="cursor: pointer;">
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                            {{ $value->reason }}</td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                            {{ $value->date }}</td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                            {{ $value->hour }}</td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                            {{ $value->lot }}</td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">

                                            {{ $value->type }}
                                        </td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                            {{ $value->name }}</td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                            {{ $value->last_name }}</td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                            {{ $value->vehicle }}</td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                            {{ $value->plate }}</td>
                                        <td
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: var(--bs-emphasis-color);">
                                        </td>
                                        <td class="text-center align-middle" style="max-height: 60px;height: 60px;">
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modules.footer')
    @include('layouts.bodyScripts')
    <script>
        // Filtro por categoría
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('filterSelect').addEventListener('change', function() {
                const selectedValue = this.value;
                const rows = document.querySelectorAll('#ipi-table tbody tr');

                rows.forEach(row => {
                    const category = row.getAttribute('data-category');

                    // Si el valor seleccionado es "14" (Todos), mostramos todas las filas
                    if (selectedValue === "0") {
                        row.style.display = '';
                    } else if (category) {
                        // Mostramos o escondemos las filas basadas en la categoría
                        if (category === selectedValue) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        })
    </script>
</body>

</html>
