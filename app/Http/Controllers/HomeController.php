<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Resources\UserResource;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'phpVersion' => PHP_VERSION,
        ]);
    }
    public function about()
    {
        return Inertia::render('Home/About', [
            'user' => new UserResource(User::find(1))
        ]);
    }
}
