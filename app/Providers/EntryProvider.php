<?php

namespace App\Providers;

use App\Models\Authorized;
use App\Models\Entry;
use App\Models\Owner;
use App\Models\Tenant;
use App\Models\Visitor;
use Illuminate\Support\Facades\Validator;

class EntryProvider
{

    public function search($request)
    {

        // Validación de entrada
        $validator = Validator::make($request->all(), [
            'dni' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Almacenar el DNI para facilitar la comparación
        $dni = $request->dni;

        // Buscar el tipo de usuario
        $type = null;
        $id = ($request->id);
        // Prioridad de búsqueda: Owner, Authorized, Tenant, Visitor
        if (Owner::where('dni', $dni)->exists()) {
            $type = 'owner';
            $data = Owner::where('dni', $dni)->first();
            $authorizeds = Authorized::where('owner', $data->id)->get() ?? [];
            $lastEntry = Entry::where('dni', $dni)->orderBy('created_at', 'desc')->first();
            $reason = $lastEntry?->reason;
        } elseif (Authorized::where('dni', $dni)->exists()) {
            $type = 'authorized';
            $data = Authorized::where('dni', $dni)->first();
            $authorizeds = null;
            $lastEntry = Entry::where('dni', $dni)->orderBy('created_at', 'desc')->first();
            $reason = $lastEntry?->reason;
        } elseif (Tenant::where('dni', $dni)->exists()) {
            $type = 'tenant';
            $data = Tenant::where('dni', $dni)->first();
            $authorizeds = null;
            $lastEntry = Entry::where('dni', $dni)->orderBy('created_at', 'desc')->first();
            $reason = $lastEntry?->reason;
        } elseif (Visitor::where('dni', $dni)->exists()) {
            $type = 'visitor';
            $data = Visitor::where('dni', $dni)->first();
            $authorizeds = Owner::where('id', $data->owner)->first() ?? [];
            $lastEntry = Entry::where('dni', $dni)->orderBy('created_at', 'desc')->first();
            $reason = $lastEntry?->reason;
        } elseif (Owner::where('lot', $dni)->exists()) {
            $type = 'owner';
            $data = Owner::where('lot', $dni)->first();
            $authorizeds = Authorized::where('owner', $data->id)->get() ?? [];
            $lastEntry = Entry::where('dni', $data->dni)->orderBy('created_at', 'desc')->first();
            $reason = $lastEntry?->reason;
        } elseif (Authorized::where('lot', $dni)->exists()) {
            $type = 'authorized';
            $data = Authorized::where('lot', $dni)->first();
            $authorizeds = null;
            $lastEntry = Entry::where('dni', $data->dni)->orderBy('created_at', 'desc')->first();
            $reason = $lastEntry?->reason;
        } elseif (Tenant::where('lot', $dni)->exists()) {
            $type = 'tenant';
            $data = Tenant::where('lot', $dni)->first();
            $authorizeds = null;
            $lastEntry = Entry::where('dni', $data->dni)->orderBy('created_at', 'desc')->first();
            $reason = $lastEntry?->reason;
        } elseif (Visitor::where('lot', $dni)->exists()) {
            $type = 'visitor';
            $data = Visitor::where('lot', $dni)->first();
            $authorizeds = Owner::where('id', $data->owner)->first() ?? [];
            $lastEntry = Entry::where('dni', $data->dni)->orderBy('created_at', 'desc')->first();
            $reason = $lastEntry?->reason;
        }

        // Retornar el tipo si se encontró, o un mensaje de error si no
        if ($type) {
            return [$type, $dni, $data, $authorizeds, $reason];
        } else {
            return ['error', $dni];
        }
    }

    public function store($request)
    {
        return match ($request->type) {
            'owner' => $this->processOwner($request),
            'authorized' => $this->processAuthorized($request),
            'tenant' => $this->processTenant($request),
            'visitor' => $this->processVisitor($request),
        };
    }

    private function processOwner($request)
    {
        // Validación de entrada
        $validator = Validator::make($request->all(), [
            'dni' => 'required',
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtener al dueño (owner)
        $owner = Owner::where('dni', $request->dni)->firstOrFail(); // Lanza excepción si no se encuentra
        $reason = $this->getReason($request->entry);

        // Inicializamos la lista de autorizados seleccionados
        $with = [];

        // Recorremos el request para encontrar todos los campos que empiecen con 'with-'
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'with-')) {
                $authorized = Authorized::where('id', $value)->first();
                if ($authorized) {
                    $with[] = $authorized; // Añadimos el autorizado si existe
                }
            }
        }

        // Procesar entradas de autorizados
        foreach ($with as $authorized) {
            $this->createEntry($authorized, $request, $reason, $type = 'Autorizado');
        }

        // Procesar entrada del dueño
        $this->createEntry($owner, $request, $reason, $type = 'Propietario');

        return true;
    }

    private function getReason($entry)
    {
        return match ($entry) {
            '0' => 'Ingreso',
            '1' => 'Salida',
            '2' => 'Salida definitiva',
            default => 'Razón no especificada',
        };
    }

    private function createEntry($person, $request, $reason, $type)
    {
        // Construir la observación dependiendo de si existe el campo 'people'
        $observation = $request->people
            ? "cantidad en auto {$request->people} / {$request->observations}"
            : $request->observations;

        // Crear la entrada
        Entry::create([
            'name' => $person->name,
            'last_name' => $person->last_name,
            'dni' => $person->dni,
            'lot' => $person->lot,
            'vehicle' => $person->vehicle,
            'plate' => $person->plate,
            'carModel' => $person->carModel,
            'color' => $person->color,
            'type' => $type,
            'date' => $request->date,
            'hour' => $request->hour,
            'reason' => $reason,
            'observation' => $observation,
        ]);
    }

    private function processAuthorized($request)
    {
        // Validación de entrada
        $validator = Validator::make($request->all(), [
            'dni' => 'required',
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtener al autorizado
        $authorized = Authorized::where('dni', $request->dni)->firstOrFail(); // Lanza excepción si no se encuentra
        $reason = $this->getReason($request->entry);

        // Procesar entrada del dueño
        $this->createEntry($authorized, $request, $reason, $type = 'Autorizado');

        return true;
    }

    private function processTenant($request)
    {

        // Validación de entrada
        $validator = Validator::make($request->all(), [
            'dni' => 'required',
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtener al autorizado
        $tenant = Tenant::where('dni', $request->dni)->firstOrFail(); // Lanza excepción si no se encuentra
        $reason = $this->getReason($request->entry);

        // Procesar entrada del dueño
        $this->createEntry($tenant, $request, $reason, $type = 'Inquilino');

        return true;
    }

    private function processVisitor($request)
    {
        // Validación de entrada
        $validator = Validator::make($request->all(), [
            'dni' => 'required',
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtener al autorizado
        $visitor = Visitor::where('dni', $request->dni)->firstOrFail(); // Lanza excepción si no se encuentra
        $reason = $this->getReason($request->entry);

        // Procesar entrada de la visita
        $this->createEntry($visitor, $request, $reason, $type = 'Visita');

        //si es salida definitiva elimina la visita
        if ($reason == 'Salida definitiva') {
            $visitor->delete();

            return true;
        }

        return true;
    }
}
