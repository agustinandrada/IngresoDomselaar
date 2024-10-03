<?php

namespace App\Http\Controllers;

use App\Services\AuthorizedService;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected $tenantService;
    protected $authorizedService;


    public function __construct(TenantService $tenantService, AuthorizedService $authorizedService)
    {
        $this->tenantService = $tenantService;
        $this->authorizedService = $authorizedService;
    }

    public function index(Request $request)
    {
        if ($request->filter != null) {
            $filter = $request->filter;
            $search = $request->search;
            switch ($filter) {
                case 'dni':
                    $tenants = $this->tenantService->getByDni($request->search);
                    break;
                case 'lot':
                    $tenants = $this->tenantService->getByLot($request->search);
                    break;
                case 'name':
                    $tenants = $this->tenantService->getByName($request->search);
                    break;
                default:
                    $tenants = $this->tenantService->getTenants();
                    break;
            }
        } else {
            $tenants = $this->tenantService->getTenants();
            $filter = 'dni';
            $search = '';
        }
        return view('admin.tenant.list', compact('tenants', 'filter', 'search'));
    }

    public function create()
    {
        $owners = $this->authorizedService->getDniOwners();
        return view('admin.tenant.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validator = $this->tenantService->createTenant($request);
        if ($validator !== true) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->route('tenant-list')->with('success', 'Propietario creado correctamente');
    }

    public function delete($id)
    {
        $this->tenantService->deleteTenant($id);
        return redirect()->route('tenant-list')->with('success', 'Propietario eliminado correctamente');
    }

    public function edit($id)
    {
        $tenant = $this->tenantService->getTenant($id);
        $owners = $this->authorizedService->getDniOwners();
        return view('admin.tenant.edit', compact('tenant', 'owners'));
    }

    public function update(Request $request, $id)
    {
        $validator = $this->tenantService->updateTenant($request, $id);
        if ($validator !== true) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->route('tenant-list')->with('success', 'Propietario actualizado correctamente');
    }

    public function view($id)
    {
        $tenant = $this->tenantService->getTenant($id);
        return view('admin.tenant.view', compact('tenant'));
    }
}
