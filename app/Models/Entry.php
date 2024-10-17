<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'lot',
        'type',
        'vehicle',
        'color',
        'carModel',
        'plate',
        'date',
        'hour',
        'reason',
        'observation',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'last_name' => 'string',
            'dni' => 'string',
            'lot' => 'string',
            'type' => 'string',
            'vehicle' => 'string',
            'plate' => 'string',
            'carModel' => 'string',
            'color' => 'string',
            'date' => 'string',
            'hour' => 'string',
            'reason' => 'string',
            'observation' => 'string',
        ];
    }
}
