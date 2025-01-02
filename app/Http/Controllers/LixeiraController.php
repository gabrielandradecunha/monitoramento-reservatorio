<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LixeiraController extends Controller
{
    public function showLixeira(){
        return view('lixeira');
    }
}
