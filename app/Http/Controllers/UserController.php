<?php

namespace App\Http\Controllers;

use App\Services\UsersServices;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar usuarios.
 *
 * Este controlador maneja las operaciones CRUD relacionadas con los usuarios,
 * incluyendo la visualización, creación, actualización y eliminación de usuarios.
 */
class UserController extends Controller
{
    /**
     * Instancia del servicio de usuarios.
     *
     * @var \App\Services\UsersServices
     */
    protected $usersService;

    /**
     * Crea una nueva instancia del controlador.
     *
     * @param \App\Services\UsersServices $usersService
     * @return void
     */
    public function __construct(UsersServices $usersService)
    {
        // Inyecta el servicio de usuarios en el controlador
        $this->usersService = $usersService;
    }

    /**
     * Muestra la lista de usuarios.
     *
     * Obtiene todos los usuarios a través del servicio y retorna la vista 'admin.manage'
     * con los datos de los usuarios.
     *
     * @return \Illuminate\View\View
     */
    public function manage(Request $request)
    {
        $filter = $request->query('f', 0);
        $users = $this->usersService->getAllUsers($filter);
        return view('admin.manage', compact('users', 'filter'));
    }

    /**
     * Muestra la vista para crear un nuevo usuario.
     *
     * Retorna la vista 'admin.create' donde se puede ingresar la información del nuevo usuario.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * Valida y almacena la información del usuario a través del servicio de usuarios,
     * y redirige a la vista de gestión de usuarios con un mensaje de éxito.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->usersService->storeUser($request);
        return redirect()->route('manage-users')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Muestra la vista para editar un usuario existente.
     *
     * Obtiene el usuario por su ID a través del servicio de usuarios y retorna la vista
     * 'admin.edit' con la información del usuario.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->usersService->getUserById($id);
        return view('admin.edit', compact('user'));
    }

    /**
     * Actualiza la información de un usuario existente.
     *
     * Valida y actualiza la información del usuario a través del servicio de usuarios,
     * y redirige a la vista de gestión de usuarios con un mensaje de éxito o error.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $updateUser = $this->usersService->updateUser($request, $id);
        if ($updateUser == 'ok') {
            return redirect()->route('manage-users')->with('success', 'Usuario actualizado correctamente');
        }
        return redirect()->route('manage-users')->with('error', 'Error al actualizar el usuario');
    }

    /**
     * Elimina un usuario existente.
     *
     * Elimina al usuario con el ID proporcionado a través del servicio de usuarios,
     * y redirige a la vista de gestión de usuarios con un mensaje de éxito.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->usersService->deleteUser($id);
        return redirect()->route('manage-users')->with('success', 'Usuario eliminado correctamente');
    }

    /**
     * Muestra la vista para ver los detalles de un usuario.
     *
     * Obtiene el usuario por su ID a través del servicio de usuarios y retorna la vista
     * 'admin.view' con la información del usuario.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $user = $this->usersService->getUserById($id);
        return view('admin.view', compact('user'));
    }
}
