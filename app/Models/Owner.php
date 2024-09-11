<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'lot',
        'email',
        'phone',
        'vehicle',
        'carModel',
        'plate',
        'photo',
        'color',
        'observation',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'last_name' => 'string',
            'dni' => 'string',
            'lot' => 'integer',
            'email' => 'string',
            'phone' => 'string',
            'vehicle' => 'string',
            'carModel' => 'string',
            'plate' => 'string',
            'photo' => 'string',
            'color' => 'string',
            'observation' => 'string',
        ];
    }
}
