<?php

namespace App\Providers;

use App\Models\Owner;
use App\Models\Tenant;
use App\Rules\MaxEntries;
use Illuminate\Validation\Rule;

class TenantProvider
{
    protected UsersProvider $usersProvider;

    public function __construct(UsersProvider $usersProvider)
    {
        $this->usersProvider = $usersProvider;
    }
    public function getTenants()
    {
        $tenants = Tenant::orderBy('created_at', 'desc')->paginate(10);
        return $tenants;
    }

    public function getByDni($dni)
    {
        $tenant = Tenant::where('dni', $dni)->orderBy('created_at', 'desc')->paginate(10);
        return $tenant;
    }

    public function getByLot($lot)
    {
        $tenant = Tenant::where('lot', $lot)->orderBy('created_at', 'desc')->paginate(10);
        return $tenant;
    }

    public function getByName($name)
    {
        $tenants = Tenant::where(function ($query) use ($name) {
            $query->where('name', 'like', "%{$name}%")
                ->orWhere('last_name', 'like', "%{$name}%")
                ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", "%{$name}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $tenants;
    }


    public function getTenant($id)
    {
        $tenant = Tenant::find($id);
        $owner = Owner::find($tenant->owner)->first();
        $tenant->owner = $owner->dni;
        return $tenant;
    }

    public function createTenant($request)
    {
        $validator = $this->validateData($request);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $tenant = new Tenant();
        $tenant->lot = $request->lot;
        $tenant->name = $request->name;
        $tenant->last_name = $request->last_name;
        $tenant->dni = $request->dni;
        $tenant->phone = $request->phone;
        $tenant->owner = $request->owner;
        $tenant->vehicle = $request->vehicle;
        $tenant->carModel = $request->model;
        $tenant->color = $request->color;
        $tenant->plate = $request->plate;
        $tenant->since = $request->since;
        $tenant->until = $request->until;
        $tenant->observation = $request->observations ?? '';
        $tenant->save();
        return true;
    }

    public function validateData($request)
    {
        $validator = validator(
            $request->all(),
            [
                'lot' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                'dni' =>  'required | unique:tenants,dni',
                'owner' => 'required | exists:owners,id',
                'phone' => 'required',
                'vehicle' => 'required',
                'model' => 'required',
                'color' => 'required',
                'since' => 'required | date | after:yesterday',
                'until' => 'required | date | after:since',
                'plate' => 'required',
            ],
            [
                'lot.required' => 'El campo Lote es obligatorio.',
                'name.required' => 'El campo Nombre es obligatorio.',
                'last_name.required' => 'El campo Apellidos es obligatorio.',
                'dni.required' => 'El campo DNI es obligatorio.',
                'owner.required' => 'El campo Propietario es obligatorio.',
                'phone.required' => 'El campo Telefono es obligatorio.',
                'vehicle.required' => 'El campo Vehículo es obligatorio.',
                'model.required' => 'El campo Marca es obligatorio.',
                'color.required' => 'El campo Color es obligatorio.',
                'plate.required' => 'El campo Placa es obligatorio.',
                'dni.unique' => 'El DNI ya existe.',
                'since.required' => 'El campo Desde es obligatorio.',
                'until.required' => 'El campo Hasta es obligatorio.',
                'since.after' => 'El campo Desde debe ser posterior al día de ayer.',
                'until.after' => 'El campo Hasta debe ser posterior al campo Desde.',
            ]
        );

        return $validator;
    }

    public function validateEditData($request, $tenantId)
    {
        $validator = validator(
            $request->all(),
            [
                'lot' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                'dni' => ['required',  Rule::unique('tenants')->ignore($tenantId)],
                'owner' => 'required | exists:owners,id',
                'phone' => 'required',
                'vehicle' => 'required',
                'model' => 'required',
                'color' => 'required',
                'plate' => 'required',
                'since' => 'required | date ',
                'until' => 'required | date | after:since',
            ],
            [
                'lot.required' => 'El campo Lote es obligatorio.',
                'name.required' => 'El campo Nombre es obligatorio.',
                'last_name.required' => 'El campo Apellidos es obligatorio.',
                'dni.required' => 'El campo DNI es obligatorio.',
                'dni.unique' => 'El DNI ya existe.',
                'owner.required' => 'El campo Propietario es obligatorio.',
                'owner.exists' => 'El campo Propietario no existe.',
                'phone.required' => 'El campo Telefono es obligatorio.',
                'vehicle.required' => 'El campo Vehímulo es obligatorio.',
                'model.required' => 'El campo Marca es obligatorio.',
                'color.required' => 'El campo Color es obligatorio.',
                'plate.required' => 'El campo Placa es obligatorio.',
                'since.required' => 'El campo Desde es obligatorio.',
                'until.required' => 'El campo Hasta es obligatorio.',
                'since.after' => 'El campo Desde debe ser posterior al día de ayer.',
                'until.after' => 'El campo Hasta debe ser posterior al campo Desde.',
            ]
        );

        return $validator;
    }

    public function updateTenant($request, $id)
    {
        $validator = $this->validateEditData($request, $id);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $tenant = Tenant::find($id);
        $tenant->lot = $request->lot;
        $tenant->name = $request->name;
        $tenant->last_name = $request->last_name;
        $tenant->dni = $request->dni;
        $tenant->owner = $request->owner;
        $tenant->phone = $request->phone;
        $tenant->vehicle = $request->vehicle;
        $tenant->carModel = $request->model;
        $tenant->color = $request->color;
        $tenant->plate = $request->plate;
        $tenant->since = $request->since;
        $tenant->until = $request->until;
        $tenant->observation = $request->observations ?? '';
        $tenant->save();
        return true;
    }

    public function deleteTenant($id)
    {
        $tenant = Tenant::find($id);
        if (!$tenant) {
            return false;
        }
        $tenant->delete();
        return true;
    }

    public function getExpiredTenants()
    {
        return Tenant::where('until', '<', date('Y-m-d'))->get();
    }
}
