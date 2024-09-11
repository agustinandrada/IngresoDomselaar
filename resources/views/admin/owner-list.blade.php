<!DOCTYPE html>
<html data-bs-theme="light" lang="es">
@include('layouts.head')

<body>
    @include('modules.nav')
    <div class="container-fluid">
        <h1
            style="font-size: 28px;margin-left: 19px;margin-top: 24px;font-family: Montserrat, sans-serif;font-weight: bold;">
            Propietarios
            Registrados</h1>
        <div class="card" id="TableSorterCard">
            <div class="card-header py-3">
                <div class="row table-topper align-items-center">
                    <form action="{{ route('owner-list') }}" method="GET" class="col-12 col-sm-5 col-md-6 text-start"
                        style="margin: 0px;padding: 5px 15px;">
                        <p style="font-family: Montserrat, sans-serif;color: var(--bs-table-color);">Filtrar Búsqueda
                            por:</p>
                        <select name="filter"
                            style="font-family: Montserrat, sans-serif;font-size: 13px; border-radius: 5px;">
                            <option value="dni" @if ($filter == 'dni') selected @endif>DNI</option>
                            <option value="lot" @if ($filter == 'lot') selected @endif>Lote</option>
                            <option value="name" @if ($filter == 'name') selected @endif>Nombre</option>
                        </select>
                        <input class="form-control-sm" type="search" name="search"
                            style="margin-left: 10px;font-family: Montserrat, sans-serif;font-size: 13px;"
                            value="{{ $search }}">
                        <button type="submit" class="btn btn-primary btn-sm"
                            style="background: #b19b76;border-width: 0px; margin-top: 20px; border-radius: 5px;">Buscar</button>
                        <a href="{{ route('owner-list') }}" class="btn btn-secondary btn-sm"
                            style="border-width: 0px; margin-top: 20px; border-radius: 5px;">Reestablecer</a>
                    </form>
                    <div class="col-12 col-sm-7 col-md-6 text-end" style="margin: 0px;padding: 5px 15px;"><i
                            class="fa fa-plus-circle"></i><a href="{{ route('create-owner') }}"
                            style="margin-left: 5px;color: var(--bs-emphasis-color);font-family: Montserrat, sans-serif;">Agregar
                            Propietario</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped tablesorter" id="ipi-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-start"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">ID</th>
                                    <th class="text-start"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">nombre</th>
                                    <th class="text-start"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">apellido</th>
                                    <th class="text-start"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">dni</th>
                                    <th class="text-start"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">lote</th>
                                    <th class="text-start"
                                        style="font-family: Montserrat, sans-serif;font-size: 13.4px;">email</th>
                                    <th class="text-center filter-false sorter-false">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($owners as $owner)
                                    <tr>
                                        <td class="text-start"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: #000;">
                                            {{ $owner->id }}</td>
                                        <td class="text-start"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: #000;">
                                            {{ $owner->name }}</td>
                                        <td class="text-start"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: #000;">
                                            {{ $owner->last_name }}</td>
                                        </td>
                                        <td class="text-start"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: #000;">
                                            {{ $owner->dni }}</td>
                                        <td class="text-start"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: #000;">
                                            {{ $owner->lot }}</td>
                                        <td class="text-start"
                                            style="font-family: Montserrat, sans-serif;font-size: 13px;color: #000;">
                                            {{ $owner->email }}</td>
                                        <td class="text-center d-flex justify-content-center align-middle"
                                            style="max-height: 60px;height: 60px;">
                                            <a class="btn btnMaterial btn-flat primary semicircle" role="button"
                                                href="#"><i class="far fa-eye" data-bs-toggle="tooltip"
                                                    data-bss-tooltip title="Ver"></i></a>

                                            <a class="btn btnMaterial btn-flat success semicircle" role="button"
                                                data-bs-toggle="tooltip" data-bss-tooltip href="#"
                                                title="Editar"><i class="fas fa-pen"></i></a>

                                            <form action="/estancias/delete-owner/{{ $owner->id }}" method="POST"
                                                id="delete-form{{ $owner->id }}">
                                                @csrf
                                                <button
                                                    class="btn btnMaterial btn-flat accent btnNoBorders checkboxHover"
                                                    type="button" title="Eliminar"
                                                    onclick="deleteUser({{ $owner->id }})"><i
                                                        class="fas fa-trash btnNoBorders" style="color: #DC3545;"
                                                        title="Eliminar"></i></button>
                                            </form>
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
    <div class="pagination justify-content-center">
        {{ $owners->links('vendor.pagination.bootstrap-4') }}
    </div>
    @include('modules.footer')
</body>

</html>
