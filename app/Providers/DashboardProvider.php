<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Entry;
use Carbon\Carbon;

class DashboardProvider extends ServiceProvider
{
    // Este método se utiliza para registrar servicios en el contenedor de Laravel
    public function register()
    {
        // Puedes registrar servicios aquí si es necesario
    }

    // Este método se utiliza para realizar acciones después de que todos los servicios han sido registrados
    public function boot()
    {
        // Puedes realizar acciones de inicialización aquí
    }

    // Método para obtener los datos del dashboard
    public function getDashboardData()
    {
        $data = Entry::whereDate('created_at', Carbon::today())->get();
        return $data;
    }
}
