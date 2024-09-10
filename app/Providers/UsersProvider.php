<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;

/**
 * Proveedor de servicios para la gestión de usuarios.
 *
 * Este proveedor maneja operaciones como la obtención, validación, almacenamiento, actualización
 * y eliminación de usuarios, además del procesamiento de fotos de perfil.
 */
class UsersProvider
{
    /**
     * Obtiene todos los usuarios.
     *
     * Llama al modelo `User` para obtener una colección de todos los usuarios en la base de datos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllUsers($f)
    {
        if ($f == 0) {
            $users = User::paginate(10);
        } elseif ($f == 1) {
            $users = User::where('role', 1)->paginate(10);
        } elseif ($f == 2) {
            $users = User::where('role', 0)->paginate(10);
        }

        return $users;
    }

    /**
     * Valida los datos para el almacenamiento de un nuevo usuario.
     *
     * Realiza la validación de los datos del formulario según las reglas definidas y retorna los errores
     * si la validación falla o `true` si es exitosa.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\MessageBag|bool
     */
    public function validateData($request)
    {
        // Validación de los datos del formulario
        $validator = validator(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => [
                    'required',
                    'min:8',
                    'same:repeat_password',
                    'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
                ],
                'user' => 'required|unique:users|numeric',
                'role' => 'required',
                'phone' => 'required|numeric',
                'last_name' => 'required',
                'repeat_password' => 'required|same:password',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'El nombre es obligatorio',
                'email.required' => 'El email es obligatorio',
                'password.required' => 'La contraseña es obligatoria',
                'user.required' => 'El usuario es obligatorio',
                'role.required' => 'El rol es obligatorio',
                'phone.required' => 'El teléfono es obligatorio',
                'last_name.required' => 'El apellido es obligatorio',
                'repeat_password.required' => 'La confirmación de contraseña es obligatoria',
                'photo.image' => 'La imagen debe ser una imagen',
                'photo.mimes' => 'La imagen debe ser en formato jpeg, png, jpg, gif, o svg',
                'photo.max' => 'La imagen no debe exceder los 2MB',
                'user.unique' => 'El usuario ya existe',
                'user.numeric' => 'El usuario debe ser un DNI',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres',
                'password.regex' => 'La contraseña debe tener una mayúscula, un número y un carácter especial',
                'password.same' => 'La contraseña debe coincidir',
            ]
        );

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return true;
        }
    }

    /**
     * Valida los datos para la edición de un usuario existente.
     *
     * Realiza la validación de los datos del formulario para la edición de un usuario, permitiendo
     * ignorar el usuario actual en la validación de email y DNI. Retorna los errores si la validación
     * falla o `true` si es exitosa.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $userId
     * @return \Illuminate\Support\MessageBag|bool
     */
    public function validateEditData($request, $userId)
    {
        // Validación de los datos del formulario para la edición
        $validator = validator(
            $request->all(),
            [
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($userId), // Ignorar el email actual del usuario
                ],
                'password' => [
                    'nullable', // No es obligatoria en la edición
                    'min:8',
                    'same:repeat_password',
                    'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
                ],
                'user' => [
                    'required',
                    'numeric',
                    Rule::unique('users')->ignore($userId), // Ignorar el DNI actual del usuario
                ],
                'role' => 'required',
                'phone' => 'required|numeric',
                'last_name' => 'required',
                'repeat_password' => 'nullable|same:password', // Solo se valida si se ingresa una nueva contraseña
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'El nombre es obligatorio',
                'email.required' => 'El email es obligatorio',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres',
                'password.regex' => 'La contraseña debe tener una mayúscula, un número y un carácter especial',
                'password.same' => 'La contraseña debe coincidir',
                'user.required' => 'El usuario es obligatorio',
                'user.numeric' => 'El usuario debe ser un DNI',
                'user.unique' => 'El usuario ya existe',
                'role.required' => 'El rol es obligatorio',
                'phone.required' => 'El teléfono es obligatorio',
                'last_name.required' => 'El apellido es obligatorio',
                'repeat_password.same' => 'La contraseña debe coincidir',
                'photo.image' => 'La imagen debe ser una imagen',
                'photo.mimes' => 'La imagen debe ser en formato jpeg, png, jpg, gif, o svg',
                'photo.max' => 'La imagen no debe exceder los 2MB',
            ]
        );

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return true;
        }
    }

    /**
     * Procesa la foto de perfil y la guarda en el sistema.
     *
     * Si se carga una foto en la solicitud, se procesa y almacena en el directorio `profile_photos`
     * con un nombre único. Retorna el path relativo de la foto guardada para su almacenamiento en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function processPhoto($request)
    {
        if ($request->hasFile('photo')) {
            // Procesa la foto de perfil antes de guardarla
            $file = $request->file('photo');
            // Define la ruta completa a la carpeta donde quieres guardar las fotos
            $destinationPath = '/home/u697317796/domains/ingresodomselaar.com.ar/public_html/profile_photos';

            // Verifica si el directorio existe; si no, lo crea
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Mueve el archivo a la ruta especificada
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);

            // Retorna el path relativo para guardar en la base de datos
            return 'profile_photos/' . $filename;
        }

        // Retorna null si no se cargó ninguna foto
        return null;
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * Valida los datos del formulario, crea un nuevo usuario con la información proporcionada
     * y guarda los datos en la base de datos. Retorna el usuario creado.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User
     */
    public function storeUser($request)
    {
        // Validación de los datos
        $validatedData = $this->validateData($request);

        if ($validatedData !== true) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Crear el usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->user = $request->input('user');
        $user->role = $request->input('role');
        $user->phone = $request->input('phone');
        $user->last_name = $request->input('last_name');
        $user->photo = $this->processPhoto($request);
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return $user;
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * Llama al modelo `User` para encontrar el usuario con el ID especificado.
     *
     * @param int $id
     * @return \App\Models\User|null
     */
    public function getUserById($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Actualiza la información de un usuario existente.
     *
     * Valida los datos del formulario para la edición, actualiza la información del usuario con el ID
     * especificado y guarda los cambios en la base de datos. Retorna 'ok' si la actualización fue exitosa.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return string
     */
    public function updateUser($request, $id)
    {
        // Validación de los datos
        $validatedData = $this->validateEditData($request, $id);

        if ($validatedData !== true) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Actualizar el usuario
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->user = $request->input('user');
        $user->role = $request->input('role');
        $user->phone = $request->input('phone');
        $user->last_name = $request->input('last_name');
        $user->photo = $this->processPhoto($request);
        $user->save();

        return 'ok';
    }

    /**
     * Elimina un usuario por su ID.
     *
     * Busca el usuario con el ID especificado, lo elimina de la base de datos y retorna 'ok' si
     * la eliminación fue exitosa. Retorna `false` si el usuario no se encuentra.
     *
     * @param int $id
     * @return string|bool
     */
    public function deleteUser($id)
    {
        // Buscar el usuario a eliminar
        $user = User::find($id);
        if (!$user) {
            return false;
        }
        $user->delete();
        return 'ok';
    }
}
