<?php

namespace App\Http\Controllers;

class Admin extends Controller
{
    public function sendStatistics()
    {
        $statistics = DB::select('select * from statistics');
    }
}
