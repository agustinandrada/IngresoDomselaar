<?php

namespace App\Services;

use App\Providers\OwnerProvider;

class OwnerServices
{

    protected $ownerProvider;

    public function __construct(OwnerProvider $ownerProvider)
    {
        $this->ownerProvider = $ownerProvider;
    }

    public function getOwners()
    {
        return $this->ownerProvider->getOwners();
    }

    public function getByDni($dni)
    {
        return $this->ownerProvider->getByDni($dni);
    }

    public function getByLot($lot)
    {
        return $this->ownerProvider->getByLot($lot);
    }

    public function getByName($name)
    {
        return $this->ownerProvider->getByName($name);
    }
}
