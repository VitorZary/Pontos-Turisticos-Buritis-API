<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagens extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagem',
        'pontos_turisticos_id',
    ];
}
