<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function showRegisterForm()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder.');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'in:admin,referee,fan',
        ]); 

        // Si NO es admin, forzamos que no pueda crearse como admin
        $role = $request->role;

        if (!auth()->check() || auth()->user()->role !== 'admin') {
            if ($role === 'admin') {
                $role = 'fan'; // seguridad extra
            }
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $role ?? 'fan',
        ]);

        Auth::login($user);
        return redirect()->route('home')->with('success', 'Usuario registrado correctamente.');
    }


    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function edit()
    {
        return view('auth.edit', ['user' => Auth::user()]);
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'in:admin,referee,fan',
        ]);

        $user->name = $request->name;

        if ($user->role === 'admin' && $request->filled('role')) {
            $user->role = $request->role;
        }

        $user->save();

        return redirect()->route('home')->with('success', 'Perfil actualizado correctamente.');
    }
}
