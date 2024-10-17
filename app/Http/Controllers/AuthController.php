<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthServices;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    /**
     * Instancia del servicio de autenticación.
     *
     * @var AuthServices
     */
    protected $authService;

    /**
     * Constructor para inicializar el servicio de autenticación.
     *
     * @param AuthServices $authService Servicio de autenticación.
     */
    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('login');
    }
    /**
     * Maneja la solicitud de inicio de sesión.
     *
     * Valida los datos de entrada y llama al servicio de autenticación para iniciar sesión.
     * Redirige a la página del panel de control si el inicio de sesión es exitoso,
     * o vuelve a la página anterior con un mensaje de error si falla.
     *
     * @param Request $request Solicitud HTTP con los datos de inicio de sesión.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'user' => 'required|numeric',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ], [
            'user.required' => 'El usuario es obligatorio',
            'user.numeric' => 'El usuario debe ser un DNI',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.regex' => 'La contraseña debe tener una mayúscula, un número y un carácter especial',
        ]);

        // Intenta iniciar sesión con los datos validados.
        $user = $this->authService->login($validatedData);
        $userData = User::where('user', $validatedData['user'])->first();

        if ($user) {
            // Almacena los datos del usuario en la sesión
            $request->session()->put('user', $userData);

            // Regenera la sesión para evitar ataques de sesión fijada
            $request->session()->regenerate();

            // Redirige al panel de control con un mensaje de éxito si el inicio de sesión es exitoso.
            return redirect()->route('dashboard');
        }

        // Redirige de vuelta con un mensaje de error si las credenciales son inválidas.
        return back()->with('error', 'Credenciales inválidas')->withInput();
    }

    /**
     * Maneja la solicitud de cierre de sesión.
     *
     * Llama al servicio de autenticación para cerrar sesión y redirige a la página de inicio de sesión
     * con un mensaje de éxito.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Elimina todos los datos de la sesión
        $request->session()->invalidate();

        // Regenera el token de la sesión para seguridad
        $request->session()->regenerateToken();

        // Redirige al usuario a la página de inicio de sesión o a otra página deseada
        return redirect('/estancias/login')->with('success', 'Sesión cerrada correctamente');
    }

    /**
     * Muestra la vista de restablecimiento de contraseña.
     *
     * Retorna la vista que permite a los usuarios solicitar un enlace para restablecer su contraseña.
     *
     * @return \Illuminate\View\View
     */
    public function resetPassword()
    {
        return view('reset');
    }

    /**
     * Envía un enlace de restablecimiento de contraseña al usuario.
     *
     * Valida la solicitud de restablecimiento de contraseña y, si el usuario existe, envía un
     * enlace de restablecimiento de contraseña al correo electrónico del usuario. Luego, redirige
     * al usuario a la página de inicio de sesión con un mensaje de éxito.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLink(Request $request)
    {
        // Valida la solicitud para asegurarse de que el campo 'user' esté presente y sea numérico
        $validate = $request->validate([
            'user' => 'required|numeric',
        ], [
            'user.required' => 'El usuario es obligatorio',
            'user.numeric' => 'El usuario debe ser un DNI',
        ]);

        // Busca el usuario en la base de datos basado en el DNI proporcionado
        $user = User::where('user', $request->user)->first();

        // Si el usuario existe, envía un enlace de restablecimiento de contraseña
        if ($user != null) {
            $this->authService->sendResetLink($user);
        }

        // Redirige al usuario a la página de inicio de sesión con un mensaje de éxito
        return redirect()->route('login')->with('success', 'Si este usuario existe, le enviamos un correo electrónico para restablecer su contraseña');
    }
}
