<?php

namespace App\Http\Controllers;

use App\Services\VisitorServices;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    protected $visitorServices;


    public function __construct(VisitorServices $visitorService)
    {
        $this->visitorServices = $visitorService;
    }

    public function index()
    {
        return view('admin.visitor.list');
    }

    public function create()
    {
        return view('admin.visitor.create');
    }

    public function store(Request $request)
    {
        $this->visitorServices->store($request);
        return redirect()->back();
    }

    public function view($id)
    {
        $data = $this->visitorServices->view($id);
        return view('admin.visitor.view', compact('data'));
    }

    public function edit($id)
    {
        $data = $this->visitorServices->edit($id);
        return view('admin.visitor.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->visitorServices->update($request, $id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->visitorServices->destroy($id);
        return redirect()->back();
    }
}
