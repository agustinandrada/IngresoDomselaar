<?php

namespace App\Http\Controllers;

use App\Services\DashboardServices;
use App\Services\TenantService;
use App\Services\VisitorServices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    protected $tenantService;
    protected $visitorService;


    /**
     * Crea una nueva instancia del controlador.
     *
     * @param \App\Services\DashboardServices $dashboardService
     * @return void
     */
    public function __construct(DashboardServices $dashboardService, TenantService $tenantService, VisitorServices $visitorServices)
    {
        // Inyecta el servicio de dashboard en el controlador
        $this->dashboardService = $dashboardService;
        $this->tenantService = $tenantService;
        $this->visitorService = $visitorServices;
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
        $tenants = $this->tenantService->getExpiredTenants();
        $visits = $this->visitorService->getExpiredVisitors();
        $visitors = $visits[0];
        $pendientes = $visits[1];
        $eliminados = 0;
        $visitas = 0;

        DB::transaction(function () use ($tenants, &$eliminados) {
            foreach ($tenants as $tenant) {
                if (Carbon::parse($tenant->until)->isPast()) {
                    $this->tenantService->deleteTenant($tenant->id);
                    $eliminados++;
                    Log::info("Inquilino eliminado con ID: {$tenant->id} cuyo contrato venció el {$tenant->until}");
                }
            }
        });

        DB::transaction(function () use ($visitors, &$visitas) {
            foreach ($visitors as $visitor) {
                if (Carbon::parse($visitor->until)->isPast()) {
                    $this->visitorService->deleteVisitor($visitor->id);
                    $visitas++;
                    Log::info("Visita eliminada con ID: {$visitor->id} cuyo visita venció el {$visitor->until}");
                }
            }
        });

        $data = $this->dashboardService->getDashboardData();
        return view('admin.dashboard', compact('eliminados', 'visitas', 'data', 'pendientes'));
    }

    public function getAllData()
    {
        $data = $this->dashboardService->getAllData();
        $selectCondition = 'todos';
        $selectType = 'todos';
        $start = null;
        $end = null;

        return view('admin.history', compact('data', 'selectCondition', 'selectType', 'start', 'end'));
    }


    public function getPeriod(Request $request)
    {
        $requestData = $request->all();
        $data = $this->dashboardService->getPeriod($requestData);

        // Preservar las selecciones anteriores
        $selectCondition = $requestData['condition'] ?? 'todos';
        $selectType = $requestData['type'] ?? 'todos';
        $start = $requestData['start'];
        $end = $requestData['end'];

        return view('admin.history', compact('data', 'selectCondition', 'selectType', 'start', 'end'));
    }


    public function getCondition(Request $request)
    {
        $requestData = $request->all();
        $selectCondition = $requestData['condition'];
        if ($selectCondition == 'todos') {
            return $this->getAllData();
        }

        // Preservar los otros filtros
        $data = $this->dashboardService->getByCondition($requestData);
        $selectType = $requestData['type'] ?? 'todos';
        $start = $requestData['start'] ?? null;
        $end = $requestData['end'] ?? null;

        return view('admin.history', compact('data', 'selectCondition', 'selectType', 'start', 'end'));
    }


    public function getType(Request $request)
    {
        $requestData = $request->all();
        $selectType = $requestData['type'];
        if ($selectType == 'todos') {
            return $this->getAllData();
        }

        // Preservar los otros filtros
        $data = $this->dashboardService->getType($requestData);
        $selectCondition = $requestData['condition'] ?? 'todos';
        $start = $requestData['start'] ?? null;
        $end = $requestData['end'] ?? null;

        return view('admin.history', compact('data', 'selectCondition', 'selectType', 'start', 'end'));
    }
}
