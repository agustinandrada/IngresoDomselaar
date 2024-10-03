<?php

namespace App\Providers;

use App\Models\User;
use App\Services\AuthServices;
use Illuminate\Support\ServiceProvider;

class AuthProvider
{
    /**
     * Simula el proceso de inicio de sesión con las credenciales proporcionadas.
     *
     * El método verifica si las credenciales proporcionadas son correctas.
     *
     * @param array $credentials Credenciales de inicio de sesión.
     * @return bool Verifica si las credenciales proporcionadas son correctas.
     */
    public function login($credentials)
    {
        $user = User::where('user', $credentials['user'])->first();

        if (!$user || !password_verify($credentials['password'], $user->password)) {
            return false;
        } else {
            return true;
        }
    }

    public function sendResetLink($user)
    {
        $email = $user->email;
        $token = $user->createToken('password-reset')->plainTextToken;
        $asunto = 'Restablecer contraseña';
        $from = 'soporte@argdg.com';
        //ENVIAR CORREO


    }


    /**
     * Método de inicialización para el proveedor de autenticación.
     *
     * En el estado actual, este método no realiza ninguna acción. Puede ser
     * utilizado para configurar servicios o inicializar componentes durante
     * el arranque de la aplicación.
     */
    public function boot()
    {
        // Método vacío; se puede usar para inicializar componentes durante el arranque.
    }
}
