<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Reservatorio;

class DashboardController extends Controller
{
    public function showDashboard(){
        $reservatorios = Reservatorio::all();
        return view('dashboard', compact('reservatorios'));
    }

    public function showReservatorio(Request $request){

        $nome = $request->nome;

        return view('reservatorio', compact('nome'));
    }
}
