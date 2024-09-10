<?php

namespace App\Http\Controllers;

use App\Services\DashboardServices;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar el panel de control.
 *
 * Este controlador maneja la visualización del panel de control y utiliza un servicio de
 * dashboard para la lógica de negocio asociada. Actualmente, solo incluye la funcionalidad
 * para mostrar la vista del panel de control.
 */
class DashboardController extends Controller
{
    /**
     * Instancia del servicio de Dashboard.
     *
     * @var \App\Services\DashboardServices
     */
    protected $dashboardService;

    /**
     * Crea una nueva instancia del controlador.
     *
     * @param \App\Services\DashboardServices $dashboardService
     * @return void
     */
    public function __construct(DashboardServices $dashboardService)
    {
        // Inyecta el servicio de dashboard en el controlador
        $this->dashboardService = $dashboardService;
    }

    /**
     * Muestra la vista del panel de control.
     *
     * Retorna la vista 'admin.dashboard' para que el usuario pueda ver el panel de control.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retorna la vista del panel de control
        return view('admin.dashboard');
    }
}
