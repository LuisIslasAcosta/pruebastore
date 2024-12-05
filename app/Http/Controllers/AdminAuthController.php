<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{
    // Mostrar el formulario de login para admins
    public function showLoginForm()
    {
        return view('admin.login-admin'); // Vista donde los admins inician sesión
    }

    // Procesar el login de los admins
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $admin = Admin::where('email', $request->email)->first();

    if (!$admin || !Hash::check($request->password, $admin->password)) {
        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    // Usar el guard 'admin'
    Auth::guard('admin')->login($admin);

    return redirect()->route('admin.dashboard');
}

    // Cerrar sesión del admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
