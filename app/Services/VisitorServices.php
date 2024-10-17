<?php

namespace App\Services;

use App\Providers\VisitorProvider;

class VisitorServices
{
    protected $visitorProvider;

    public function __construct(VisitorProvider $visitorProvider)
    {
        $this->visitorProvider = $visitorProvider;
    }

    public function getVisitor($id)
    {
        return $this->visitorProvider->getVisitor($id);
    }

    public function getVisitors()
    {
        return $this->visitorProvider->getVisitors();
    }

    public function getByDni($dni)
    {
        return $this->visitorProvider->getByDni($dni);
    }
    public function getByLot($lot)
    {
        return $this->visitorProvider->getByLot($lot);
    }

    public function getByName($name)
    {
        return $this->visitorProvider->getByName($name);
    }

    public function createVisitor($request)
    {
        return $this->visitorProvider->createVisitor($request);
    }

    public function deleteVisitor($request)
    {
        return $this->visitorProvider->deleteVisitor($request);
    }

    public function updateVisitor($request, $visitor)
    {
        return $this->visitorProvider->updateVisitor($request, $visitor);
    }

    public function getExpiredVisitors()
    {
        return  $this->visitorProvider->getExpiredVisitors();
    }
}
