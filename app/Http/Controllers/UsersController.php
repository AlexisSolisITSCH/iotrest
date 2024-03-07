<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //consultar todos los usuarios
    public function index(){
        return User::paginate();
    }

    //consultar un usuario
    public function show($id){
        return User::find($id);
    }

    //crear un usuario
    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }

    //actualizar usuario
    public function update(Request $request, $id){
        if($request->username){
            $exist = User::where('username', $request->username)->first();
            if($exist) return response()->json(['error' => 'el usuario ya existe'], 409);
        }
        $user = User::find($id);
        if(!$user) return response('', 404);
        $user->fill($request->all());
        if($request->password)
            $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }

    //eliminar usuario
    public function destroy($id){
        $user = User::find($id);
        if(!user) return response('', 404); 
        $user->delete();
        return $user;
    }

}
