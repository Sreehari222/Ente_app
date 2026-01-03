<?php

// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        return view('sales.recommendation'); 
    }
}