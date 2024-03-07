<?php

namespace App\Http\Controllers;

use App\Models\User;

class ExampleController extends Controller
{
    
    public function index(){
        return User::all();
    }

    public function show($id){
        return User::find($id);
    }
}
