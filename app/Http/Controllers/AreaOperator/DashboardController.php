<?php

namespace App\Http\Controllers\AreaOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('area_operator.dashboard');
    }
}
