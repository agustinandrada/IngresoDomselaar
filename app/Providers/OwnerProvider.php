<?php

namespace App\Providers;

use App\Models\Owner;


class OwnerProvider
{
    protected UsersProvider $usersProvider;

    public function __construct(UsersProvider $usersProvider)
    {
        $this->usersProvider = $usersProvider;
    }
    public function getOwners()
    {
        $owners = Owner::paginate(10);
        return $owners;
    }

    public function getByDni($dni)
    {
        $owner = Owner::where('dni', $dni)->paginate(10);
        return $owner;
    }

    public function getByLot($lot)
    {
        $owner = Owner::where('lot', $lot)->paginate(10);
        return $owner;
    }

    public function getByName($name)
    {
        $owner = Owner::where('name', $name)
            ->orWhere('last_name', $name)
            ->paginate(10);
        return $owner;
    }

    public function getOwner($id)
    {
        $owner = Owner::find($id);
        return $owner;
    }

    public function createOwner($request)
    {
        $validator = $this->validateData($request);
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

        return $owner;
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

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return true;
        }
    }

    public function updateOwner($request, $owner)
    {
        $validator = $this->validateData($request);
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
    }

    public function deleteOwner($request)
    {
        $owner = Owner::find($request);
        $owner->delete();

        if (Owner::find($request)) {
            return false;
        } else {
            return true;
        }
    }
}
