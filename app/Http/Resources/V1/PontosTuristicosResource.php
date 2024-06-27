<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PontosTuristicosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'usuario_que_cadastrou' => $this->user->nome,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'imagens' => ImagensResource::collection($this->imagens)
        ];
    }

}
