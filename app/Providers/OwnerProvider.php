<?php

namespace App\Providers;

use App\Models\Owner;


class OwnerProvider
{
    public function getOwners()
    {
        $owners = Owner::paginate(10);
        return $owners;
    }

    public function getByDni($dni)
    {
        $owner = Owner::where('dni', $dni)->first();
        return $owner;
    }

    public function getByLot($lot)
    {
        $owner = Owner::where('lot', $lot)->first();
        return $owner;
    }

    public function getByName($name)
    {
        $owner = Owner::where('name', $name)->first();
        return $owner;
    }
}
