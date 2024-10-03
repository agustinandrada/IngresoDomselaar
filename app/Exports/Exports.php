<?php

namespace App\Exports;

use App\Models\Authorized;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\Visitor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Exports implements FromView
{
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function view(): View
    {
        if ($this->type === 'owners') {
            $data = Owner::all();
        } elseif ($this->type === 'authorizeds') {
            $data = Authorized::all();
        } elseif ($this->type === 'tenants') {
            $data = Tenant::all();
        } elseif ($this->type === 'visitors') {
            $data = Visitor::all();
        } else {
            $data = collect(); // Devuelve una colección vacía si el tipo no es válido
        }

        return view('exports.owners', [
            'owners' => $data,
        ]);
    }
}
