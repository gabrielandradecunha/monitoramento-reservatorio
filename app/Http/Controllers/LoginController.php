<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard'); // Redireciona após o login
        }

        return back()->withErrors([
            'email' => 'As credenciais não correspondem aos nossos registros.',
        ]);
    }

    public function showLoginForm(){
        return view('login');
    }
}
