<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use HttpResponses;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'usuario_que_cadastrou' => 'nullable|numeric',
        ]);

        if($validator->fails()){
            return $this->error('Dados Inválidos', 422, $validator->errors());
        }

        $created = User::create($validator->validated());

        if($created){
            return $this->response('Usuário criado', 200, new UserResource($created));
        }
        return $this->error('Usuário não criado', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'usuario_que_cadastrou' => 'nullable|numeric',
        ]);

        if($validator->fails()){
            return $this->error('Dados inválidos', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = $user->update([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'usuario_que_cadastrou' => $validated['nullable|numeric'],
        ]);

        if($updated){
            return $this->response('Usuário atualizado', 200, new UserResource($user));
        }

        return $this->error('Usuário não atualizado', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();

        if($deleted){
            return $this->response('Usuário deletado', 200);
        }

        return $this->error('Usuário não deletado', 400);
    }
}
