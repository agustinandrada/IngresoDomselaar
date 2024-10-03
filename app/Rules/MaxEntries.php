<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MaxEntries implements Rule
{
    protected $table;
    protected $column;
    protected $maxEntries;

    public function __construct($table, $column, $maxEntries)
    {
        $this->table = $table;
        $this->column = $column;
        $this->maxEntries = $maxEntries;
    }

    public function passes($attribute, $value)
    {
        $count = DB::table($this->table)
            ->where($this->column, $value)
            ->count();

        return $count < $this->maxEntries;
    }

    public function message()
    {
        return 'El número de autorizados ha alcanzado el límite permitido para este propietario.';
    }
}
