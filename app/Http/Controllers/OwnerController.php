<?php

namespace App\Http\Controllers;

use App\Services\OwnerServices;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    /**
     * Instancia del servicio de Owner.
     *
     * @var \App\Services\OwnerServices
     */
    protected $ownerService;

    /**
     * Crea una nueva instancia del controlador.
     *
     * @param \App\Services\OwnerServices $ownerService
     * @return void
     */
    public function __construct(OwnerServices $ownerService)
    {
        $this->ownerService = $ownerService;
    }

    /**
     * Muestra la vista de listado de propietarios.
     *
     * Retorna la vista 'admin.owner-list' para que el usuario pueda ver la lista de propietarios.
     *
     * @return \Illuminate\View\View
     *
     */
    public function index(Request $request)
    {
        if ($request->filter != null) {
            $filter = $request->filter;
            $search = $request->search;
            switch ($filter) {
                case 'dni':
                    $owners = $this->ownerService->getByDni($request->search);
                    break;
                case 'lot':
                    $owners = $this->ownerService->getByLot($request->search);
                    break;
                case 'name':
                    $owners = $this->ownerService->getByName($request->search);
                    break;
                default:
                    $owners = $this->ownerService->getOwners();
                    break;
            }
        } else {
            $owners = $this->ownerService->getOwners();
            $filter = 'dni';
            $search = '';
        }
        return view('admin.owner-list', compact('owners', 'filter', 'search'));
    }

    public function create()
    {
        return view('admin.owner-create');
    }

    public function store(Request $request)
    {
        $this->ownerService->createOwner($request);
        return redirect()->route('owner-list')->with('success', 'Propietario creado correctamente');
    }

    public function delete($id)
    {
        $this->ownerService->deleteOwner($id);
        return redirect()->route('owner-list')->with('success', 'Propietario eliminado correctamente');
    }

    // public function edit($id)
    // {
    //     $owner = $this->ownerService->getOwner($id);
    //     return view('admin.owner-edit', compact('owner'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $this->ownerService->updateOwner($request, $id);
    //     return redirect()->route('owner.index');
    // }

    // public function view($id)
    // {
    //     $owner = $this->ownerService->getOwner($id);
    //     return view('admin.owner-view', compact('owner'));
    // }
}
