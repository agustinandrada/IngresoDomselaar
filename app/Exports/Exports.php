<?php

namespace App\Exports;

use App\Models\Authorized;
use App\Models\Entry;
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
            return view('exports.owners', [
                'owners' => $data,
            ]);
        } elseif ($this->type === 'authorizeds') {
            $data = Authorized::all();
            return view('exports.owners', [
                'owners' => $data,
            ]);
        } elseif ($this->type === 'tenants') {
            $data = Tenant::all();
            return view('exports.tenants', [
                'tenants' => $data,
            ]);
        } elseif ($this->type === 'visitors') {
            $data = Visitor::all();
            return view('exports.visitors', [
                'visitors' => $data,
            ]);
        } elseif ($this->type === 'history') {
            $data = Entry::all();
            return view('exports.history', [
                'historys' => $data,
            ]);
        } else {
            $data = collect(); // Devuelve una colección vacía si el tipo no es válido
            return view('exports.owners', [
                'owners' => $data,
            ]);
        }
    }
}
