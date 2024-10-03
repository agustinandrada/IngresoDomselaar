<?php

namespace App\Services;

use App\Providers\AuthorizedProvider;

class AuthorizedService
{
    /**
     * Instancia del proveedor de autenticación.
     *
     * @var AuthorizedProvider
     */
    protected $authorizedProvider;

    /**
     * Constructor para inicializar el proveedor de autenticación.
     *
     * @param AuthorizedProvider $authorizedProvider Proveedor de autenticación.
     */
    public function __construct(AuthorizedProvider $authorizedProvider)
    {
        $this->authorizedProvider = $authorizedProvider;
    }

    public function getAuthorized($id)
    {
        return $this->authorizedProvider->getAuthorized($id);
    }

    public function getAuthorizeds()
    {
        return $this->authorizedProvider->getAuthorizeds();
    }

    public function getByDni($dni)
    {
        return $this->authorizedProvider->getByDni($dni);
    }

    public function getByLot($lot)
    {
        return $this->authorizedProvider->getByLot($lot);
    }

    public function getByName($name)
    {
        return $this->authorizedProvider->getByName($name);
    }

    public function createAuthorized($request)
    {
        return $this->authorizedProvider->createAuthorized($request);
    }

    public function deleteAuthorized($request)
    {
        return $this->authorizedProvider->deleteAuthorized($request);
    }

    public function updateAuthorized($request, $id)
    {
        return $this->authorizedProvider->updateAuthorized($request, $id);
    }

    public function getDniOwners(): array
    {
        return $this->authorizedProvider->getDniOwners();
    }
}
