<?php

namespace App\Services;

use App\Providers\UsersProvider;

/**
 * Servicio para gestionar operaciones relacionadas con usuarios.
 *
 * Este servicio actúa como intermediario entre el controlador y el proveedor de usuarios,
 * manejando las operaciones de obtención, almacenamiento, actualización y eliminación de usuarios.
 */
class UsersServices
{
    /**
     * Instancia del proveedor de usuarios.
     *
     * @var \App\Providers\UsersProvider
     */
    protected $usersProvider;

    /**
     * Crea una nueva instancia del servicio.
     *
     * @param \App\Providers\UsersProvider $usersProvider
     * @return void
     */
    public function __construct(UsersProvider $usersProvider)
    {
        // Inyecta el proveedor de usuarios en el servicio
        $this->usersProvider = $usersProvider;
    }

    /**
     * Obtiene todos los usuarios.
     *
     * Llama al método del proveedor de usuarios para obtener todos los usuarios y retorna
     * los resultados.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllUsers($f)
    {
        $users = $this->usersProvider->getAllUsers($f);
        return $users;
    }

    /**
     * Almacena un nuevo usuario.
     *
     * Llama al método del proveedor de usuarios para almacenar la información del usuario
     * y retorna el resultado de la operación.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function storeUser($request)
    {
        $storeUser = $this->usersProvider->storeUser($request);
        return $storeUser;
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * Llama al método del proveedor de usuarios para obtener un usuario específico por su ID
     * y retorna la información del usuario.
     *
     * @param int $id
     * @return \App\Models\User|null
     */
    public function getUserById($id)
    {
        $user = $this->usersProvider->getUserById($id);
        return $user;
    }

    /**
     * Actualiza la información de un usuario.
     *
     * Llama al método del proveedor de usuarios para actualizar la información del usuario
     * con el ID especificado y retorna el resultado de la operación.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return mixed
     */
    public function updateUser($request, $id)
    {
        $updateUser = $this->usersProvider->updateUser($request, $id);
        return $updateUser;
    }

    /**
     * Elimina un usuario por su ID.
     *
     * Llama al método del proveedor de usuarios para eliminar un usuario con el ID especificado
     * y retorna `true` si la eliminación fue exitosa, `false` en caso contrario.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser($id)
    {
        $deleteUser = $this->usersProvider->deleteUser($id);
        if ($deleteUser == 'ok') {
            return true;
        }
        return false;
    }
}
