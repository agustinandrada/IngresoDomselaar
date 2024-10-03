<?php

namespace App\Http\Controllers;

use App\Services\AuthorizedService;
use Illuminate\Http\Request;

class AuthorizedController extends Controller
{
    protected $authorizedService;


    public function __construct(AuthorizedService $authorizedService)
    {
        $this->authorizedService = $authorizedService;
    }

    public function index(Request $request)
    {
        if ($request->filter != null) {
            $filter = $request->filter;
            $search = $request->search;
            switch ($filter) {
                case 'dni':
                    $authorizeds = $this->authorizedService->getByDni($request->search);
                    break;
                case 'lot':
                    $authorizeds = $this->authorizedService->getByLot($request->search);
                    break;
                case 'name':
                    $authorizeds = $this->authorizedService->getByName($request->search);
                    break;
                default:
                    $authorizeds = $this->authorizedService->getAuthorizeds();
                    break;
            }
        } else {
            $authorizeds = $this->authorizedService->getAuthorizeds();
            $filter = 'dni';
            $search = '';
        }
        return view('admin.authorized.list', compact('authorizeds', 'filter', 'search'));
    }

    public function create()
    {
        $owners = $this->authorizedService->getDniOwners();
        return view('admin.authorized.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validator = $this->authorizedService->createAuthorized($request);
        if ($validator !== true) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->route('authorized-list')->with('success', 'Autorizado creado correctamente');
    }

    public function delete($id)
    {
        $this->authorizedService->deleteAuthorized($id);
        return redirect()->route('authorized-list')->with('success', 'Autorizado eliminado correctamente');
    }

    public function edit($id)
    {
        $authorized = $this->authorizedService->getAuthorized($id);
        $owners = $this->authorizedService->getDniOwners();
        return view('admin.authorized.edit', compact('authorized', 'owners'));
    }

    public function update(Request $request, $id)
    {
        $validator = $this->authorizedService->updateAuthorized($request, $id);

        if ($validator !== true) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->route('authorized-list')->with('success', 'Autorizado actualizado correctamente');
    }

    public function view($id)
    {
        $authorized = $this->authorizedService->getAuthorized($id);
        return view('admin.authorized.view', compact('authorized'));
    }
}
