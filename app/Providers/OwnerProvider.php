<?php

namespace App\Providers;

use App\Models\Authorized;
use App\Models\Owner;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OwnerProvider
{
    protected UsersProvider $usersProvider;

    public function __construct(UsersProvider $usersProvider)
    {
        $this->usersProvider = $usersProvider;
    }
    public function getOwners()
    {
        $owners = Owner::orderBy('created_at', 'desc')->paginate(10);
        return $owners;
    }

    public function getByDni($dni)
    {
        $owner = Owner::where('dni', $dni)->orderBy('created_at', 'desc')->paginate(10);
        return $owner;
    }

    public function getByLot($lot)
    {
        $owner = Owner::where('lot', $lot)->orderBy('created_at', 'desc')->paginate(10);
        return $owner;
    }

    public function getByName($name)
    {
        $owners = Owner::where(function ($query) use ($name) {
            $query->where('name', 'like', "%{$name}%")
                ->orWhere('last_name', 'like', "%{$name}%")
                ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", "%{$name}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $owners;
    }


    public function getOwner($id)
    {
        $owner = Owner::find($id);
        return $owner;
    }

    public function createOwner($request)
    {
        $validator = $this->validateData($request);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $owner = new Owner();
        $owner->lot = $request->lot;
        $owner->name = $request->name;
        $owner->last_name = $request->last_name;
        $owner->dni = $request->dni;
        $owner->email = $request->email;
        $owner->phone = $request->phone;
        $owner->vehicle = $request->vehicle;
        $owner->carModel = $request->model;
        $owner->color = $request->color;
        $owner->plate = $request->plate;
        $owner->photo = $this->usersProvider->processPhoto($request);
        $owner->observation = $request->observation ?? '';
        $owner->save();

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
                'dni' => 'required|unique:owners',
                'email' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'phone' => 'required',
                'vehicle' => 'required',
                'model' => 'required',
                'color' => 'required',
                'plate' => 'required',
            ],
            [
                'lot.required' => 'El campo Lote es obligatorio.',
                'name.required' => 'El campo Nombre es obligatorio.',
                'last_name.required' => 'El campo Apellidos es obligatorio.',
                'dni.required' => 'El campo DNI es obligatorio.',
                'email.required' => 'El campo Email es obligatorio.',
                'photo.image' => 'El campo Foto debe ser una imagen.',
                'phone.required' => 'El campo Telefono es obligatorio.',
                'vehicle.required' => 'El campo Vehículo es obligatorio.',
                'model.required' => 'El campo Marca es obligatorio.',
                'color.required' => 'El campo Color es obligatorio.',
                'plate.required' => 'El campo Placa es obligatorio.',
                'dni.unique' => 'El DNI ya existe.',
            ]
        );

        return $validator;
    }

    public function validateEditData($request, $ownerId)
    {
        $validator = validator(
            $request->all(),
            [
                'lot' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                'dni' => ['required',  Rule::unique('owners')->ignore($ownerId)],
                'email' => 'required',
                'phone' => 'required',
                'vehicle' => 'required',
                'model' => 'required',
                'color' => 'required',
                'plate' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'lot.required' => 'El campo Lote es obligatorio.',
                'name.required' => 'El campo Nombre es obligatorio.',
                'last_name.required' => 'El campo Apellidos es obligatorio.',
                'dni.required' => 'El campo DNI es obligatorio.',
                'dni.unique' => 'El DNI ya existe.',
                'email.required' => 'El campo Email es obligatorio.',
                'phone.required' => 'El campo Telefono es obligatorio.',
                'vehicle.required' => 'El campo Vehímulo es obligatorio.',
                'model.required' => 'El campo Marca es obligatorio.',
                'color.required' => 'El campo Color es obligatorio.',
                'plate.required' => 'El campo Placa es obligatorio.',
                'photo.image' => 'El campo Foto debe ser una imagen.',
            ]
        );

        return $validator;
    }

    public function updateOwner($request, $id)
    {
        $validator = $this->validateEditData($request, $id);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $owner = Owner::find($id);
        $owner->lot = $request->lot;
        $owner->name = $request->name;
        $owner->last_name = $request->last_name;
        $owner->dni = $request->dni;
        $owner->email = $request->email;
        $owner->phone = $request->phone;
        $owner->vehicle = $request->vehicle;
        $owner->carModel = $request->model;
        $owner->color = $request->color;
        $owner->plate = $request->plate;
        $owner->photo = $this->usersProvider->processPhoto($request);
        $owner->observation = $request->observation ?? '';
        $owner->save();
        return true;
    }

    public function deleteOwner($id)
    {
        // Asume que $request contiene el ID del propietario que deseas eliminar.
        $owner = Owner::find($id); // Busca el Owner por ID
        if (!$owner) {
            return false; // Si no existe, retornar false.
        }

        $ownerDni = $owner->dni;

        // Usamos una transacción para asegurar que todo se elimine de manera consistente.
        DB::transaction(function () use ($owner, $ownerDni) {
            // Eliminar todos los autorizados que coincidan con el DNI del propietario.
            Authorized::where('owner', $ownerDni)->delete();

            // Eliminar el propietario.
            $owner->delete();
        });

        // Verificar si el propietario sigue existiendo
        return Owner::find($id) === null; // Retornará true si fue eliminado exitosamente.

    }
}
