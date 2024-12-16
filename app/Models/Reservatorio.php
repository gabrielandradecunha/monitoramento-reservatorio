<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservatorio extends Model
{
    use HasFactory;

    protected $table = 'reservatorios';

    // Definindo os campos que são "mass assignable" (que podem ser preenchidos em massa)
    protected $fillable = [
        'nome',
        'volume_maximo',
        'volume_atual',
        'ultima_atualizacao',
        'user_id',
    ];

    // Relacionamento com o usuário que criou o reservatório
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
