<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservatorio;
use App\Models\HistoricoReservatorio;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUsers(){
        $usuarios = User::all();
        return view('admin.users', compact('usuarios'));
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        
        if (!$usuario) {
            return redirect('/users')->with('error', 'Usuário não encontrado');
        }
    
        $reservatorios = Reservatorio::where('user_id', $usuario->id)->get();
        
        foreach ($reservatorios as $reservatorio) {
            HistoricoReservatorio::where('reservatorio_id', $reservatorio->id)->delete();
        }
        
        $reservatorios->each->delete();
        
        $usuario->delete();
        
        return redirect('/users')->with('success', 'Usuário e seus reservatórios excluídos com sucesso');
    }
    

    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'is_admin' => 'required|boolean',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->is_admin = $request->is_admin ?? 0;
        $usuario->save();

        return redirect('/users')->with('success', 'Usuário criado com sucesso');
    }
}
