<?php

namespace App\Providers;

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
                'owner' => 'required',
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
                'phone' => 'required',
                'vehicle' => 'required',
                'model' => 'required',
                'color' => 'required',
                'plate' => 'required',
                'since' => 'required | date | after:yesterday',
                'until' => 'required | date | after:since',
            ],
            [
                'lot.required' => 'El campo Lote es obligatorio.',
                'name.required' => 'El campo Nombre es obligatorio.',
                'last_name.required' => 'El campo Apellidos es obligatorio.',
                'dni.required' => 'El campo DNI es obligatorio.',
                'dni.unique' => 'El DNI ya existe.',
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
        // Asume que $request contiene el ID del propietario que deseas eliminar.
        $tenant = Tenant::find($id); // Busca el tenant por ID
        if (!$tenant) {
            return false; // Si no existe, retornar false.
        }

        $tenantDni = $tenant->dni;

        // Usamos una transacción para asegurar que todo se elimine de manera consistente.
        DB::transaction(function () use ($tenant, $tenantDni) {
            // Eliminar todos los autorizados que coincidan con el DNI del propietario.
            Tenant::where('tenant', $tenantDni)->delete();

            // Eliminar el propietario.
            $tenant->delete();
        });

        // Verificar si el propietario sigue existiendo
        return Tenant::find($id) === null; // Retornará true si fue eliminado exitosamente.

    }
}
