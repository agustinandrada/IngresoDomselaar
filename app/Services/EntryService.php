<?php

namespace App\Services;

use App\Providers\EntryProvider;

class EntryService
{
    private $entryProvider;

    public function __construct(EntryProvider $entryProvider)
    {
        $this->entryProvider =  $entryProvider;
    }

    public function search($dni)
    {
        return $this->entryProvider->search($dni);
    }

    public function store($request)
    {
        return $this->entryProvider->store($request);
    }
}
