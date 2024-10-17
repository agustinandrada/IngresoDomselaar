<?php

namespace App\Http\Controllers;

use App\Services\EntryService;
use Illuminate\Http\Request;

class EntryController extends Controller
{

    protected $entryService;

    public function __construct(EntryService $entryService)
    {
        $this->entryService = $entryService;
    }


    public function search(Request $request)
    {
        $type = $this->entryService->search($request);

        return match ($type[0]) {
            'owner' => view('admin.entry.owner', ['owner' => $type[2], 'authorizeds' => $type[3], 'lastEntry' => $type[4]]),
            'authorized' => view('admin.entry.authorized', ['authorized' => $type[2], 'lastEntry' => $type[4]]),
            'tenant' => view('admin.entry.tenant', ['tenant' => $type[2], 'lastEntry' => $type[4]]),
            'visitor' => view('admin.entry.visitor', ['visitor' => $type[2], 'lastEntry' => $type[4], 'owner' => $type[3]]),
            'error' => redirect()->back()->with('error', "El DNI {$type[1]} no está registrado."),
            default => redirect()->back()->with('error', 'No se pudo encontrar el tipo de usuario.'),
        };
    }

    public function store(Request $request)
    {
        $result = $this->entryService->store($request);

        return match ($result) {
            true => redirect()->route('dashboard')->with('success', 'Entrada creada correctamente'),
            false => redirect()->back()->with('error', 'No se pudo registrar la entrada'),
        };
    }
}
