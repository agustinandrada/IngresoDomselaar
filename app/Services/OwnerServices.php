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


    public function getOwner($id)
    {
        return $this->ownerProvider->getOwner($id);
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

    public function createOwner($request)
    {
        return $this->ownerProvider->createOwner($request);
    }

    public function deleteOwner($request)
    {
        return $this->ownerProvider->deleteOwner($request);
    }

    public function updateOwner($request, $owner)
    {
        return $this->ownerProvider->updateOwner($request, $owner);
    }
}
