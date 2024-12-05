<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Mostrar el dashboard del admin
    public function index()
    {
        return view('admin.dashboard'); // Vista que se mostrará al administrador
    }
    
}
