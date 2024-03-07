<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actuator; //eloquent orm model

class ActuatorsController extends Controller
{
    public function index(){
        return Actuator::paginate();
    }

    public function show($id){
        return Actuator::find($id);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:actuators',
            'type' => 'required',
            'value' => 'required',
            'date' => 'required',
            'user_id' => 'required'
        ]);
        $Actuator = new Actuator;
        $Actuator->fill($request->all());
        $Actuator->date = date('Y-m-d H:i:s');
        $Actuator->user_id = $request->user()->id;
        $Actuator->save();
        return $Actuator;
    }

    public function update(Request $request, $id){
        $Actuator = Actuator::find($id);
        if(!$Actuator) return response('', 404);
        $Actuator->fill($request->all());
        $Actuator->save();
        return $Actuator;
    }

    public function destroy($id){
        $Actuator = Actuator::find($id);
        if(!$Actuator) return response('', 404); 
        $Actuator->delete();
        return $Actuator;
    }
}
