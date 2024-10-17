<?php

namespace App\Services;

use App\Models\Entry;
use Carbon\Carbon;

class DashboardServices
{

    public function getDashboardData()
    {
        $data = Entry::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get();

        return $data;
    }

    public function getallData()
    {
        return Entry::orderBy('created_at', 'desc')->paginate(50);
    }

    public function getPeriod($data)
    {
        $result = Entry::whereBetween('created_at', [$data['start'], $data['end']])->paginate(50);
        return $result;
    }

    public function getByCondition($data)
    {
        $result = Entry::where('type', $data['condition'])->paginate(50);
        return $result;
    }

    public function getType($data)
    {
        $result = Entry::where('reason', $data['type'])->paginate(50);
        return $result;
    }
}
