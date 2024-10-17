<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Services\AuthorizedService;
use App\Services\VisitorServices;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    protected $visitorService;
    protected $authorizedService;


    public function __construct(VisitorServices $visitorServices, AuthorizedService $authorizedService)
    {
        $this->visitorService = $visitorServices;
        $this->authorizedService = $authorizedService;
    }

    public function index(Request $request)
    {
        if ($request->filter != null) {
            $filter = $request->filter;
            $search = $request->search;
            switch ($filter) {
                case 'dni':
                    $visitors = $this->visitorService->getByDni($request->search);
                    break;
                case 'lot':
                    $visitors = $this->visitorService->getByLot($request->search);
                    break;
                case 'name':
                    $visitors = $this->visitorService->getByName($request->search);
                    break;
                default:
                    $visitors = $this->visitorService->getVisitors();
                    break;
            }
        } else {
            $visitors = $this->visitorService->getVisitors();
            $filter = 'dni';
            $search = '';
        }
        return view('admin.visitor.list', compact('visitors', 'filter', 'search'));
    }

    public function create()
    {
        $owners = $this->authorizedService->getDniOwners();
        return view('admin.visitor.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validator = $this->visitorService->createVisitor($request);
        if ($validator !== true) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->route('visitor-list')->with('success', 'Visita creada correctamente');
    }

    public function delete($id)
    {
        $this->visitorService->deleteVisitor($id);
        return redirect()->route('visitor-list')->with('success', 'Visita eliminada correctamente');
    }

    public function edit($id)
    {
        $visitor = $this->visitorService->getVisitor($id);
        $owners = $this->authorizedService->getDniOwners();
        return view('admin.visitor.edit', compact('visitor', 'owners'));
    }

    public function update(Request $request, $id)
    {
        $validator = $this->visitorService->updateVisitor($request, $id);
        if ($validator !== true) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return redirect()->route('visitor-list')->with('success', 'Visita actualizada correctamente');
    }

    public function view($id)
    {
        $visitor = $this->visitorService->getVisitor($id);
        return view('admin.visitor.view', compact('visitor'));
    }
}
