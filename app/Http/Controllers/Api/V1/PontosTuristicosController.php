<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PontosTuristicosResource;
use App\Models\PontosTuristicos;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PontosTuristicosController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'ability:user'])->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return PontosTuristicosResource::collection(PontosTuristicos::paginate(10));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|unique:pontos_turisticos',
            'descricao' => 'required',
            'user_id' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if($validator->fails()){
            return $this->error('Dado invalido', 422, $validator->errors());
        }

        $created = PontosTuristicos::create($validator->validated());

        if($created){
            return $this->response('Ponto Turístico criado', 200, new PontosTuristicosResource($created->load('user')));
        }
        return $this->error('Ponto Turístico não criado', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(PontosTuristicos $pontosturistico)
    {
        return new PontosTuristicosResource($pontosturistico);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PontosTuristicos $pontosturistico)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'descricao' => 'required',
            'user_id' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if($validator->fails()){
            return $this->error('Falha na Validação', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = $pontosturistico->update([
            'titulo' => $validated['titulo'],
            'descricao' => $validated['descricao'],
            'user_id' => $validated['user_id'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude']
        ]);

        if($updated){
            return $this->response('Ponto Turístico atualizado', 200, new PontosTuristicosResource($pontosturistico->load('user')));
        }

        return $this->error('Ponto Turístico não atualizado', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PontosTuristicos $pontosturistico)
    {
        $deleted = $pontosturistico->delete();

        if($deleted){
            return $this->response('Ponto Turístico deletado', 200);
        }

        return $this->error('Ponto Turístico não deletado', 400);
    }
}
