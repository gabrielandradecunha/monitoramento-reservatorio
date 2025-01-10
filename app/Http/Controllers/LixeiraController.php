<?php

namespace App\Http\Controllers;

use App\Models\Lixeira;
use App\Models\Reservatorio;
use App\Models\HistoricoReservatorio;
use Illuminate\Http\Request;

class LixeiraController extends Controller
{

    public function restaurar(Request $request){
        $lixeira = Lixeira::find($request->id);
		
        if ($lixeira) {
            $reservatorio = new Reservatorio();
            $reservatorio->id = $lixeira->id;
            $reservatorio->nome = $lixeira->nome;
            $reservatorio->volume_maximo = $lixeira->volume_maximo;
            $reservatorio->volume_atual = $lixeira->volume_atual;
            $reservatorio->user_id = $lixeira->user_id;
            $reservatorio->descricao = $lixeira->descricao;
            $reservatorio->ultima_atualizacao = $lixeira->ultima_atualizacao;
            $reservatorio->save();

            $lixeira->delete();

            return redirect('/dashboard');
        }



    }

    public function deleteLixo(Request $request){
	
        $lixeira = Lixeira::find($request->id);

        if ($lixeira) {
            $lixeira->delete();

            $historico = HistoricoReservatorio::where('reservatorio_id', '=', $lixeira->id)->get();
            // para deleter todas as entidades obtidas com a consulta acima
            $historico->each(function ($item) {
                $item->delete();
            });

            return redirect('/dashboard')->with('success', 'Reservatório deletado com sucesso');
        }
    }

    public function showLixeira(Request $request){

        $lixos = Lixeira::where('user_id', '=', $request->id)->get();	
        return view('lixeira', compact('lixos'));
    }
}
