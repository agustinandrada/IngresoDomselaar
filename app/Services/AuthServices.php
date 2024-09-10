<?php

namespace App\Services;

use App\Providers\AuthProvider;
use Illuminate\Support\Facades\Auth;

class AuthServices
{
    /**
     * Instancia del proveedor de autenticación.
     *
     * @var AuthProvider
     */
    protected $authProvider;

    /**
     * Constructor para inicializar el proveedor de autenticación.
     *
     * @param AuthProvider $authProvider Proveedor de autenticación.
     */
    public function __construct(AuthProvider $authProvider)
    {
        $this->authProvider = $authProvider;
    }

    /**
     * Intenta autenticar al usuario con las credenciales proporcionadas.
     *
     * Llama al método de inicio de sesión del proveedor de autenticación.
     * En el estado actual, siempre devuelve false, lo cual indica que el
     * inicio de sesión no se realiza correctamente.
     *
     * @param array $credentials Credenciales de inicio de sesión.
     * @return bool Devuelve true si el inicio de sesión es exitoso, o false si falla.
     */
    public function login(array $credentials)
    {
        // Intenta autenticar al usuario usando el proveedor de autenticación.
        $response = $this->authProvider->login($credentials);

        //Devuelve el resultado de la autenticación.
        return $response;
    }

    /**
     * Cierra la sesión del usuario actual.
     *
     * Utiliza el facade Auth para cerrar la sesión del usuario.
     */
    public function logout()
    {
        // Cierra la sesión del usuario actual.
        Auth::logout();
    }

    public function sendResetLink($user)
    {
        $this->authProvider->sendResetLink($user);
    }
}
