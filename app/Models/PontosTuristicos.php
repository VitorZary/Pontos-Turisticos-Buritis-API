<?php

namespace App\Models;

use App\Http\Resources\V1\ImagensResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PontosTuristicos extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'user_id',
        'latitude',
        'longitude'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function imagens()
    {
        return $this->hasMany(Imagens::class);
    }

}
