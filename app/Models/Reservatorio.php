<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservatorio extends Model 
{

    protected $table = 'reservatorios';

    protected $fillable = [
        'nome',
        'volume_maximo',
        'volume_atual',
        'ultima_atualizacao',
        'descricao',
        'user_id',
    ];

}
