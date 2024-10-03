<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorized extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'lot',
        'email',
        'vehicle',
        'carModel',
        'plate',
        'photo',
        'color',
        'observation',
        'owner' => 'string',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'last_name' => 'string',
            'dni' => 'string',
            'lot' => 'string',
            'email' => 'string',
            'vehicle' => 'string',
            'carModel' => 'string',
            'plate' => 'string',
            'photo' => 'string',
            'color' => 'string',
            'observation' => 'string',
            'owner' => 'string',
        ];
    }
}
