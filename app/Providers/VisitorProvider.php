<?php

namespace App\Providers;

use App\Models\Entry;
use App\Models\Visitor;
use Illuminate\Validation\Rule;

class VisitorProvider
{
    protected UsersProvider $usersProvider;

    public function __construct(UsersProvider $usersProvider)
    {
        $this->usersProvider = $usersProvider;
    }
    public function getVisitors()
    {
        $visitors = Visitor::orderBy('created_at', 'desc')->paginate(10);
        return $visitors;
    }

    public function getByDni($dni)
    {
        $visitor = Visitor::where('dni', $dni)->orderBy('created_at', 'desc')->paginate(10);
        return $visitor;
    }

    public function getByLot($lot)
    {
        $visitor = Visitor::where('lot', $lot)->orderBy('created_at', 'desc')->paginate(10);
        return $visitor;
    }

    public function getByName($name)
    {
        $visitors = Visitor::where(function ($query) use ($name) {
            $query->where('name', 'like', "%{$name}%")
                ->orWhere('last_name', 'like', "%{$name}%")
                ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", "%{$name}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $visitors;
    }


    public function getVisitor($id)
    {
        $visitor = Visitor::find($id);
        return $visitor;
    }

    public function createVisitor($request)
    {
        $since = $request->since;
        $until = $request->until;
        if ($request->since == null) {
            //seteo que el valor por defecto sea hoy
            $today = date('Y-m-d');
            $since =  $today;
        }
        if ($request->until == null) {
            //seteo que el valor por defecto sea mañana
            $tomorrow = date('Y-m-d', strtotime('+1 day'));
            $until =  $tomorrow;
        }

        $validator = $this->validateData($request);
        if ($validator->fails()) {
            return $validator->errors();
        }

        //since debe ser posterior al dia de ayer
        if ($since > $until) {
            return ['since' => 'El campo Desde debe ser posterior al día de ayer.'];
        }
        $visitor = new Visitor();
        $visitor->lot = $request->lot;
        $visitor->name = $request->name;
        $visitor->last_name = $request->last_name;
        $visitor->dni = $request->dni;
        $visitor->owner = $request->owner;
        $visitor->vehicle = $request->vehicle;
        $visitor->carModel = $request->model;
        $visitor->color = $request->color;
        $visitor->plate = $request->plate;
        $visitor->since = $since;
        $visitor->until = $until;
        $visitor->observation = $request->observations ?? '';
        $visitor->save();
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
                'dni' =>  'required | unique:Visitors,dni',
                'owner' => 'required',
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
                'owner.required' => 'El campo Propietario es obligatorio.',
                'vehicle.required' => 'El campo Vehículo es obligatorio.',
                'model.required' => 'El campo Marca es obligatorio.',
                'color.required' => 'El campo Color es obligatorio.',
                'plate.required' => 'El campo Placa es obligatorio.',
                'dni.unique' => 'El DNI ya existe.',
            ]
        );

        return $validator;
    }

    public function validateEditData($request, $visitorId)
    {
        $validator = validator(
            $request->all(),
            [
                'lot' => 'required',
                'name' => 'required',
                'last_name' => 'required',
                'dni' => ['required',  Rule::unique('Visitors')->ignore($visitorId)],
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

    public function updateVisitor($request, $id)
    {
        $validator = $this->validateEditData($request, $id);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $visitor = Visitor::find($id);
        $visitor->lot = $request->lot;
        $visitor->name = $request->name;
        $visitor->last_name = $request->last_name;
        $visitor->dni = $request->dni;
        $visitor->owner = $request->owner;
        $visitor->vehicle = $request->vehicle;
        $visitor->carModel = $request->model;
        $visitor->color = $request->color;
        $visitor->plate = $request->plate;
        $visitor->since = $request->since;
        $visitor->until = $request->until;
        $visitor->observation = $request->observations ?? '';
        $visitor->save();
        return true;
    }

    public function deleteVisitor($id)
    {
        $visitor = Visitor::find($id);
        if (!$visitor) {
            return false;
        }
        $visitor->delete();
        return true;
    }

    public function getExpiredVisitors()
    {
        $visitasPendientes = [];
        $visitasFinalizadas = [];

        // Obtener las visitas cuya fecha `until` ha pasado.
        $visitors = Visitor::where('until', '<', date('Y-m-d'))->get();

        foreach ($visitors as $visitor) {
            // Verificar si el visitante tiene una salida definitiva en la tabla `Entry`.
            $entry = Entry::where('dni', $visitor->dni)
                ->where('reason', 'Salida definitiva')
                ->first();

            if ($entry) {
                // Si tiene una salida definitiva, agregarlo a la lista de visitas finalizadas.
                $visitasFinalizadas[] = $visitor;
            } else {
                // Si no tiene una salida definitiva, agregarlo a la lista de visitas pendientes.
                $visitasPendientes[] = $visitor;
            }
        }

        // Ahora tienes dos arrays: $visitasFinalizadas y $visitasPendientes.
        return [
            $visitasFinalizadas,
            $visitasPendientes
        ];
    }
}
