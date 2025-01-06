<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lixeira extends Model
{
    protected $table = 'lixeira';

    protected $fillable = [
        'nome',
        'volume_maximo',
        'volume_atual',
        'ultima_atualizacao',
        'descricao',
        'user_id',
    ];
}
