<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservatorio;

class ReservatorioController extends Controller
{
    public function destroy($id)
    {
        $reservatorio = Reservatorio::find($id);

        if ($reservatorio) {
            $reservatorio->delete(); 
            return redirect('/dashboard')->with('success', 'Reservatório deletado com sucesso!');
        }

        return redirect('/dashboard')->with('error', 'Reservatório não encontrado!');
    }

}