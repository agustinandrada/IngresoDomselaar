<?php

namespace App\Providers;

use App\Models\Authorized;
use App\Models\Owner;
use App\Rules\MaxEntries;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;

class AuthorizedProvider
{
    protected UsersProvider $usersProvider;

    public function __construct(UsersProvider $usersProvider)
    {
        $this->usersProvider = $usersProvider;
    }
    public function getAuthorizeds()
    {
        $authorizeds = Authorized::orderBy('created_at', 'desc')->paginate(10);
        return $authorizeds;
    }

    public function getByDni($dni)
    {
        $authorized = Authorized::where('dni', $dni)->orderBy('created_at', 'desc')->paginate(10);
        return $authorized;
    }

    public function getByLot($lot)
    {
        $authorized = Authorized::where('lot', $lot)->orderBy('created_at', 'desc')->paginate(10);
        return $authorized;
    }

    public function getByName($name)
    {
        $authorizeds = Authorized::where(function ($query) use ($name) {
            $query->where('name', 'like', "%{$name}%")
                ->orWhere('last_name', 'like', "%{$name}%")
                ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", "%{$name}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $authorizeds;
    }

    public function getAuthorized($id)
    {
        $authorized = Authorized::find($id);
        return $authorized;
    }

    public function createAuthorized($request)
    {
        $validator = $this->validateData($request);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $authorized = new Authorized();
        $authorized->lot = $request->lot;
        $authorized->name = $request->name;
        $authorized->last_name = $request->last_name;
        $authorized->dni = $request->dni;
        $authorized->email = $request->email;
        $authorized->vehicle = $request->vehicle;
        $authorized->carModel = $request->model;
        $authorized->color = $request->color;
        $authorized->plate = $request->plate;
        $authorized->photo = $this->usersProvider->processPhoto($request);
        $authorized->observation = $request->observation ?? '';
        $authorized->owner = $request->owner;
        $authorized->save();

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
                'owner' => ['required', 'exists:owners,dni', new MaxEntries('authorizeds', 'owner', 3)],
                'dni' => 'required|unique:authorizeds',
                'email' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
                'vehicle.required' => 'El campo Vehículo es obligatorio.',
                'model.required' => 'El campo Marca es obligatorio.',
                'color.required' => 'El campo Color es obligatorio.',
                'plate.required' => 'El campo Placa es obligatorio.',
                'dni.unique' => 'El DNI ya existe.',
                'owner.max_entries' => 'El número de autorizados ha alcanzado el límite permitido para este propietario.',
                'owner.exists' => 'El propietario no existe.',
            ]
        );

        return $validator;
    }

    public function validateEditData($request, $authorizedId)
    {
        $validator = validator(
            $request->all(),
            [
                'lot' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                'dni' => ['required', Rule::unique('authorizeds')->ignore($authorizedId)],
                'owner' => ['required', new MaxEntries('authorizeds', 'owner', 3)], // Elimina el espacio antes de "exists"
                'email' => 'required|email',
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
                'vehicle.required' => 'El campo Vehímulo es obligatorio.',
                'model.required' => 'El campo Marca es obligatorio.',
                'color.required' => 'El campo Color es obligatorio.',
                'plate.required' => 'El campo Placa es obligatorio.',
                'photo.image' => 'El campo Foto debe ser una imagen.',
                'owner.max_entries' => 'El número de autorizados ha alcanzado el límite permitido para este propietario.',
                'owner.exists' => 'El propietario no existe.',
            ]
        );

        return $validator;
    }

    public function updateAuthorized($request, $id)
    {
        $validator = $this->validateEditData($request, $id);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $authorized = Authorized::find($id);
        $authorized->lot = $request->lot;
        $authorized->name = $request->name;
        $authorized->last_name = $request->last_name;
        $authorized->dni = $request->dni;
        $authorized->email = $request->email;
        $authorized->vehicle = $request->vehicle;
        $authorized->carModel = $request->model;
        $authorized->color = $request->color;
        $authorized->plate = $request->plate;
        $authorized->photo = $this->usersProvider->processPhoto($request);
        $authorized->observation = $request->observation ?? '';
        $authorized->owner = $request->owner;
        $authorized->save();
        return true;
    }

    public function deleteAuthorized($request)
    {
        $authorized = Authorized::find($request);
        $authorized->delete();

        if (Authorized::find($request)) {
            return false;
        } else {
            return true;
        }
    }

    public function getDniOwners(): array
    {
        $owners = Owner::all();
        $dniOwners = [];
        foreach ($owners as $owner) {
            $dniOwners[$owner->dni] = [
                'id' => $owner->id,
                'lot' => $owner->lot,
            ];
        }
        return $dniOwners;
    }
}
