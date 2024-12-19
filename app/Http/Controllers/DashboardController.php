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

        $id = $request->id;

        $reservatorios = Reservatorio::find($id);

        return view('reservatorio', compact('reservatorios'));
    }
}
