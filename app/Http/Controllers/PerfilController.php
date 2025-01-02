<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Reservatorio;

class PerfilController extends Controller
{
   public function showPerfil(Request $request){

        $reservatorios = Reservatorio::all();

        return view('perfil', compact('reservatorios'));

   }

   public function update(Request $request){
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255'
        ]);

        $usuario = User::find($request->id);
        $reservatorios = Reservatorio::all();

        if (!$usuario) {
            return back()->withErrors(['error' => 'Usuário não encontrado!']);
        }

        if ($request->has('name')) {
            $usuario->name = $request->name;
        }

        if ($request->has('email')) {
            $usuario->email = $request->email;
        }

        $usuario->save();

        return redirect()->route("perfil", $usuario->id)->with('success', 'Usuário atualizado com sucesso!');
    }

   
}
