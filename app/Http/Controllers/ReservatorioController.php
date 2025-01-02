<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservatorio;
use App\Models\HistoricoReservatorio;
use Carbon\Carbon; 

class ReservatorioController extends Controller
{
    public function showReservatorio(Request $request)
    {
        $id = $request->id;
        $reservatorio = Reservatorio::find($id);
        $historico_reservatorio = HistoricoReservatorio::where('reservatorio_id', '=', $id)->get();

        return view('reservatorio', compact('reservatorio', 'historico_reservatorio'));
    }

    public function update(Request $request){

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'volume_maximo' => 'required|numeric|min:0',
            'volume_atual' => 'required|numeric|min:0'
        ]);

        if ($validated) {
            $reservatorio = Reservatorio::find($request->id);
            $reservatorio->nome = $request->nome;
            $reservatorio->volume_maximo = $request->volume_maximo;
            $reservatorio->volume_atual = $request->volume_atual;
            $reservatorio->descricao = $request->descricao;
            $reservatorio->ultima_atualizacao = Carbon::now();
            $reservatorio->save();
    
            return redirect('/dashboard')->with('success', 'Reservatório criado com sucesso!');
        }
        
    }

    public function destroy($id)
    {
        $reservatorio = Reservatorio::find($id);

        if ($reservatorio) {
            $reservatorio->delete();
            HistoricoReservatorio::where('reservatorio_id', '=', $id)->delete();
            return redirect('/dashboard')->with('success', 'Reservatório deletado com sucesso!');
        }

        return redirect('/dashboard')->with('error', 'Reservatório não encontrado!');
    }
}
