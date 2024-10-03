<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'lot',
        'phone',
        'owner',
        'vehicle',
        'carModel',
        'plate',
        'color',
        'dateDelete',
        'observation',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'last_name' => 'string',
            'dni' => 'string',
            'lot' => 'string',
            'phone' => 'string',
            'owner' => 'string',
            'vehicle' => 'string',
            'carModel' => 'string',
            'plate' => 'string',
            'color' => 'string',
            'since' => 'string',
            'until' => 'string',
            'observation' => 'string',
        ];
    }
}
