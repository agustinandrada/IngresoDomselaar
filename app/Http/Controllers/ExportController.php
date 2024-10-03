<?php

namespace App\Http\Controllers;

use App\Exports\Exports;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportOwners()
    {
        return Excel::download(new Exports('owners'), 'Propietarios.xlsx');
    }

    public function exportAuthorized()
    {
        return Excel::download(new Exports('authorizeds'), 'Autorizados.xlsx');
    }

    public function exportVisitors()
    {
        return Excel::download(new Exports('visitors'), 'Visitas.xlsx');
    }

    public function exportTenants()
    {
        return Excel::download(new Exports('tenants'), 'Inquilinos.xlsx');
    }
}
