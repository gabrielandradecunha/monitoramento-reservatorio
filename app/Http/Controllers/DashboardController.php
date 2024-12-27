<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservatorio;
use Carbon\Carbon; 

class DashboardController extends Controller
{
    public function showDashboard(){
        $reservatorios = Reservatorio::all();
        return view('dashboard', compact('reservatorios'));

    }

    public function showReservatorio(Request $request){
        $id = $request->id;
        $reservatorio = Reservatorio::find($id);

        return view('reservatorio', compact('reservatorio'));
    }

    public function createReservatorio(Request $request){

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'volume_maximo' => 'required|numeric|min:0',
            'volume_atual' => 'required|numeric|min:0',
        ]);
    
        if ($validated) {
            $reservatorio = new Reservatorio();
            $reservatorio->nome = $request->nome;
            $reservatorio->volume_maximo = $request->volume_maximo;
            $reservatorio->volume_atual = $request->volume_atual;
            $reservatorio->user_id = $request->id;
            $reservatorio->ultima_atualizacao = Carbon::now();
            $reservatorio->save();
    
            return redirect('/dashboard')->with('success', 'Reservatório criado com sucesso!');
        }
    }
}
