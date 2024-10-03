<?php

namespace App\Services;

use App\Providers\VisitorProvider;

class VisitorServices
{
    /**
     * Instancia del proveedor de autenticación.
     *
     * @var VisitorProvider
     */
    protected $visitorProvider;

    /**
     * Constructor para inicializar el proveedor de autenticación.
     *
     * @param VisitorProvider $VisitorProvider Proveedor de autenticación.
     */
    public function __construct(VisitorProvider $visitorProvider)
    {
        $this->visitorProvider = $visitorProvider;
    }
}
