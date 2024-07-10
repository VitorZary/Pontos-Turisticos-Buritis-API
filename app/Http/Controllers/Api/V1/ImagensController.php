<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ImagensResource;
use App\Models\Imagens;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ImagensController extends Controller
{
    use HttpResponses;
    /**
     * Store a newly created resource in storage.
     */

    public function index(){
        return ImagensResource::collection(Imagens::all());
    }

    public function store(Request $request)
    {
        $images = new Imagens();

        $validator = Validator::make($request->all(), [
            'imagem' => 'required|max:2048',
            'pontos_turisticos_id' => 'required|numeric'
        ]);

        if($validator->fails()){
            return $this->error('Dado invalido', 422, $validator->errors());
        }

        $filename = '';
        if($request->hasFile('imagem')){
            $filename = $request->file('imagem')->store('imagens', 'public');
        }else{
            $filename = null;
        }

        $images->imagem = $filename;
        $images->pontos_turisticos_id = $request->pontos_turisticos_id;

        $created = $images->save();
        
        if($created){
            return $this->response('Imagem salva', 200, new ImagensResource($images));
        }
        return $this->error('Imagem não salva', 400);

    }

    public function show(Imagens $imagen)
    {
        return new ImagensResource($imagen);
    }

    public function update(Request $request, Imagens $imagen)
    {
        $validator = Validator::make($request->all(), [
            'imagem' => 'required|max:2048',
            'pontos_turisticos_id' => 'required|numeric'
        ]);

        if($validator->fails()){
            return $this->error('Dado invalido', 422, $validator->errors());
        }

        $destination = public_path("storage\\".$imagen->imagem);

        if(File::exists($destination)){
            File::delete($destination);
        }

        $filename = '';
        if($request->hasFile('imagem')){
            $filename = $request->file('imagem')->store('imagens', 'public');
        }else{
            $filename = null;
        }

        $updated = $imagen->update([
            'imagem' => $filename,
            'pontos_turisticos_id' => $request->pontos_turisticos_id
        ]);

        if($updated){
            return $this->response('Imagem atualizada', 200, new ImagensResource($imagen));
        }

        return $this->error('Imagem não atualizada', 400);
    }

    public function destroy(Imagens $imagen){
        $destination = public_path("storage\\".$imagen->imagem);
        
        if(File::exists($destination)){
            File::delete($destination);
        }

        $deleted = $imagen->delete();

        if($deleted){
            return $this->response('Imagem deletada', 200);
        }

        return $this->error('Imagem não deletada', 400);
    }

}
