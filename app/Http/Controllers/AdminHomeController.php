<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminHomeController extends Controller
{
    public function index() 
    {
        return Inertia::render('Admin/Home/Index', []);
    }
}
