<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body>
    @include('modules.nav')
    <div class="d-flex flex-column min-vh-100 p-1">
        <div class="card" style="height: 100%;">
            <div class="card-header py-3">
                <div class="container" style="margin-top: 50px;">
                    <div class="row">
                        <!-- Filtro por Período -->
                        <div class="col-xl-5">
                            <form action="{{ route('history-search-period') }}" method="POST">
                                @csrf
                                <p class="fw-semibold"
                                    style="color: var(--bs-emphasis-color);font-family: Montserrat, sans-serif;font-size: 14px;">
                                    Seleccione el período a Consultar (Desde - Hasta)
                                </p>
                                <input type="hidden" name="condition" value="{{ $selectCondition }}">
                                <input type="hidden" name="type" value="{{ $selectType }}">
                                <input class="form-control-sm" type="date" name="start" value="{{ $start }}"
                                    style="font-family: Montserrat, sans-serif;font-size: 15px;width: 175px;">
                                <input class="form-control-sm" type="date" name="end" value="{{ $end }}"
                                    style="margin-left: 15px;font-family: Montserrat, sans-serif;font-size: 15px;width: 175px;">
                                <button class="btn btn-primary mt-3" type="submit"
                                    style="margin-left: 15px;background: rgb(177,155,118); border-width: 0px">Consultar</button>
                            </form>
                        </div>

                        <!-- Filtro por Condición -->
                        <div class="col-xl-3">
                            <form action="{{ route('history-search-condition') }}" method="POST">
                                @csrf
                                <p class="fw-semibold"
                                    style="color: var(--bs-emphasis-color);font-family: Montserrat, sans-serif;font-size: 14px;">
                                    Condición
                                </p>
                                <input type="hidden" name="start" value="{{ $start }}">
                                <input type="hidden" name="end" value="{{ $end }}">
                                <input type="hidden" name="type" value="{{ $selectType }}">
                                <select class="form-select-sm mt-3" style="width: 100%;" name="condition"
                                    onchange="this.form.submit()">
                                    <option value="todos" {{ $selectCondition == 'todos' ? 'selected' : '' }}>Todos
                                    </option>
                                    <option value="Propietario"
                                        {{ $selectCondition == 'Propietario' ? 'selected' : '' }}>Propietarios</option>
                                    <option value="Autorizado"
                                        {{ $selectCondition == 'Autorizado' ? 'selected' : '' }}>Autorizados</option>
                                    <option value="Visita" {{ $selectCondition == 'Visita' ? 'selected' : '' }}>Visitas
                                    </option>
                                    <option value="Inquilino" {{ $selectCondition == 'Inquilino' ? 'selected' : '' }}>
                                        Inquilinos</option>
                                </select>
                            </form>
                        </div>

                        <!-- Filtro por Tipo -->
                        <div class="col-xl-3">
                            <form action="{{ route('history-search-type') }}" method="POST">
                                @csrf
                                <p class="fw-semibold"
                                    style="color: var(--bs-emphasis-color);font-family: Montserrat, sans-serif;font-size: 14px;">
                                    Tipo de Registro
                                </p>
                                <input type="hidden" name="start" value="{{ $start }}">
                                <input type="hidden" name="end" value="{{ $end }}">
                                <input type="hidden" name="condition" value="{{ $selectCondition }}">
                                <select class="form-select-sm mt-3" style="width: 100%;" name="type"
                                    onchange="this.form.submit()">
                                    <option value="todos" {{ $selectType == 'todos' ? 'selected' : '' }}>Todos
                                    </option>
                                    <option value="Ingreso" {{ $selectType == 'Ingreso' ? 'selected' : '' }}>Ingresos
                                    </option>
                                    <option value="Salida" {{ $selectType == 'Salida' ? 'selected' : '' }}>Egresos
                                    </option>
                                </select>
                            </form>
                        </div>
                        <div class="col-xl-1 d-xl-flex justify-content-xl-center align-items-xl-center"
                            style="padding-right: 0px;padding-left: 0;"><button class="btn btn-primary" type="button"
                                style="margin-right: 0;margin-bottom: 0;margin-left: 0;margin-top: 27px;background: rgb(177,155,118); border-width: 0px"><i
                                    class="fa fa-file-excel-o" style="font-size: 19px;"
                                    onclick="window.open('{{ route('export-history') }}', '_blank')"></i></button>
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
                                            style="font-family: Montserrat, sans-serif;font-size: 13.4px;">VEHÍCULO
                                        </th>
                                        <th class="text-center filter-false sorter-false"
                                            style="font-family: Montserrat, sans-serif;font-size: 13.4px;">PATENTE</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($data as $value)
                                        <tr data-category="{{ $value->type }}">
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
                                                <?php
                                                $url = match ($value->type) {
                                                    'Propietario' => '/estancias/view-owner/' . $value->id,
                                                    'Autorizado' => '/estancia/view-authorized/' . $value->id,
                                                    'Visita' => '/estancia/view-visitor/' . $value->id,
                                                    'Inquilino' => '/estancia/view-tenant/' . $value->id,
                                                };
                                                ?>
                                                <a href="{{ $url }}"
                                                    style="color: var(--bs-table-color);">{{ $value->type }}</a>
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
                                            <td class="text-center align-middle"
                                                style="max-height: 60px;height: 60px;">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination justify-content-center">
                {{ $data->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
    @include('modules.footer')
    @include('layouts.bodyScripts')
</body>

</html>
