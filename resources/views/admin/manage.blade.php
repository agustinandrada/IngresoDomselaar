<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

@include('layouts.head')

<body id="manage-users">
    @include('modules.nav')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="container-fluid">
        <h1 style="font-size: 28px;margin-left: 23px;margin-top: 24px;">Administradores y Usuarios</h1>
        <div class="card" id="TableSorterCard">
            <div class="card-header py-3">
                <div class="row table-topper align-items-center">
                    <div class="col-12 col-sm-5 col-md-6 text-start" style="margin: 0px;padding: 5px 15px;">
                        <select id="filter" onchange="filterByRole()">
                            <option value="0" @if ($filter == 0) selected @endif>Todos</option>
                            <option value="1" @if ($filter == 1) selected @endif>Administradores
                            </option>
                            <option value="2" @if ($filter == 2) selected @endif>Usuarios</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-7 col-md-6 text-end" style="margin: 0px;padding: 5px 15px;"><i
                            class="fa fa-plus-circle"></i><a href="/estancias/create-user"
                            style="margin-left: 5px;">Agregar
                            Administrador / Usuario</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped tablesorter" id="ipi-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-start">Usuario</th>
                                    <th class="text-start">Nombre</th>
                                    <th class="text-start">apellido</th>
                                    <th class="text-start">email</th>
                                    <th class="text-start">rol</th>
                                    <th class="text-center filter-false sorter-false">Acciones</th>
                                </tr>
                            </thead>
                            @foreach ($users as $user)
                                <tbody class="text-center">
                                    <tr>
                                        <td class="text-start">{{ $user->id }}</td>
                                        <td class="text-start">{{ $user->name }}</td>
                                        <td class="text-start">{{ $user->last_name }}</td>
                                        <td class="text-start">{{ $user->email }}</td>
                                        <td class="text-start">{{ $user->role == 1 ? 'Administrador' : 'Usuario' }}
                                        </td>
                                        <td class="text-center d-flex justify-content-center align-middle"
                                            style="max-height: 60px;height: 60px;">
                                            <a class="btn btnMaterial btn-flat primary semicircle" role="button"
                                                href="/estancias/view-user/{{ $user->id }}"><i class="far fa-eye"
                                                    data-bs-toggle="tooltip" data-bss-tooltip="" title="Ver"></i></a>

                                            <a class="btn btnMaterial btn-flat success semicircle" role="button"
                                                data-bs-toggle="tooltip" data-bss-tooltip=""
                                                href="/estancias/edit-user/{{ $user->id }}" title="Editar"><i
                                                    class="fas fa-pen"></i></a>
                                            <form action="/estancias/delete-user/{{ $user->id }}" method="POST"
                                                id="delete-form{{ $user->id }}">
                                                @csrf
                                                <button
                                                    class="btn btnMaterial btn-flat accent btnNoBorders checkboxHover"
                                                    style="margin-left: 5px;" type="button" title="Eliminar"
                                                    onclick="deleteUser({{ $user->id }})"><i
                                                        class="fas fa-trash btnNoBorders" style="color: #DC3545;"
                                                        title="Eliminar"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr></tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pagination justify-content-center">
        {{ $users->appends(['f' => $filter])->links('vendor.pagination.bootstrap-4') }}
    </div>

    @include('modules.footer')
</body>

</html>
