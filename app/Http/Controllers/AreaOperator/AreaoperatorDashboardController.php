<?php

namespace App\Http\Controllers\AreaOperator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreaoperatorDashboardController extends Controller
{
    public function dashboard(){
        return view('area_operator.dashboard');
    }
}
