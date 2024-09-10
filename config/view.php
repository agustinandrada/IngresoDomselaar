<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar las rutas donde Laravel buscará las vistas.
    | Por defecto, Laravel utiliza la carpeta "resources/views".
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | View Compiled Path
    |--------------------------------------------------------------------------
    |
    | Esta opción determina dónde serán almacenadas las vistas compiladas
    | por el motor de plantillas Blade. Por lo general, no es necesario cambiarla.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

    /*
    |--------------------------------------------------------------------------
    | Pagination View
    |--------------------------------------------------------------------------
    |
    | Esta opción te permite definir la vista de paginación predeterminada que
    | Laravel utilizará al generar los enlaces de paginación. Puedes especificar
    | cualquiera de las vistas de paginación publicadas en "resources/views/vendor/pagination".
    |
    */

    'pagination' => 'vendor.pagination.vendor.pagination.bootstrap-4', // Cambia 'default' por la plantilla que prefieras
];
