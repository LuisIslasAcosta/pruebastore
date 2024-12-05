<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function register(Request $request){
        //Validar Datos

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        
        Auth::login($user);

        return redirect(route('privada'));
    }
    public function login(Request $request){
        //Validacion

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
            
        ];

        $remember = ($request->has('remember') ? true : false);
        if(Auth::attempt($credentials,$remember)){
            $request->session()->regenerate();

            return redirect()->intended('privada');
        }else{
            return redirect('login');
        }
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');  // Asegúrate de crear la vista admin-login
    }

    // Manejar el login de administrador
    public function adminLogin(Request $request)
    {
        // Validar los datos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        // Verificar si el usuario es administrador
        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->hasRole('admin') && Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');  // Ruta del dashboard del admin
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son válidas o no tienes acceso de administrador.',
        ]);
    }
}
