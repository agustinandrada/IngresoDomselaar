<?php

namespace App\Services;

use App\Providers\TenantProvider;

class TenantService
{
    /**
     * Instancia del proveedor de autenticación.
     *
     * @var TenantProvider
     */
    protected $tenantProvider;

    /**
     * Constructor para inicializar el proveedor de autenticación.
     *
     * @param TenantProvider $TenantProvider Proveedor de autenticación.
     */
    public function __construct(TenantProvider $tenantProvider)
    {
        $this->tenantProvider = $tenantProvider;
    }


    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Obtiene un inquilino por su ID.
     *
     * @param int $id ID del inquilino a obtener.
     *
     * @return mixed
     */
    /******  d1708289-931f-4a4a-84f4-add04f0902c1  *******/
    public function getTenant($id)
    {
        return $this->tenantProvider->getTenant($id);
    }


    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Obtiene un listado de todos los inquilinos.
     *
     * Llama al método del proveedor de autenticación para obtener todos los inquilinos y retorna
     * los resultados.
     *
     * @return \Illuminate\Support\Collection
     */
    /******  24d75952-b23f-4102-b5bd-346e02ed81dd  *******/
    public function getTenants()
    {
        return $this->tenantProvider->getTenants();
    }


    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Obtiene un inquilino por su DNI.
     *
     * @param int $dni DNI del inquilino.
     *
     * @return mixed
     */
    /******  11c35ca1-a384-4b89-94fc-c2896688738c  *******/
    public function getByDni($dni)
    {
        return $this->tenantProvider->getByDni($dni);
    }


    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Obtener un listado de arrendatarios por su lote.
     *
     * @param string $lot Lote del arrendatario.
     *
     * @return mixed
     */
    /******  b0c03c30-b47e-43f1-aaa5-7b0fd11411d0  *******/
    public function getByLot($lot)
    {
        return $this->tenantProvider->getByLot($lot);
    }


    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Obtiene un inquilino por su nombre completo.
     *
     * @param string $name Nombre completo del inquilino.
     *
     * @return mixed
     */
    /******  e00c8173-8944-4c5e-b5f4-58fc618faa04  *******/
    public function getByName($name)
    {
        return $this->tenantProvider->getByName($name);
    }



    public function createTenant($request)
    {
        return $this->tenantProvider->createTenant($request);
    }


    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Elimina un inquilino existente
     *
     * Llama al método del proveedor de autenticación para eliminar un inquilino y retorna
     * los resultados.
     *
     * @param \Illuminate\Http\Request $request Request con los datos del inquilino a eliminar.
     *
     * @return mixed
     */
    /******  550192e7-89fe-48b4-be4b-e9604c6ca60c  *******/
    public function deleteTenant($request)
    {
        return $this->tenantProvider->deleteTenant($request);
    }

    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Actualiza un inquilino existente
     *
     * @param $request Request con los datos actualizados del inquilino
     * @param $Tenant Tenant a actualizar
     *
     * @return Tenant actualizado
     */
    /******  8fbbf00e-4cd3-415f-9f85-473d243d2f00  *******/
    public function updateTenant($request, $tenant)
    {
        return $this->tenantProvider->updateTenant($request, $tenant);
    }

    public function getExpiredTenants()
    {
        return  $this->tenantProvider->getExpiredTenants();
    }
}
