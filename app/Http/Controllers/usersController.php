<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\users;
use Illuminate\Http\Request;
//use App\Controllers\Controller;

class usersController extends Controller
{

    public function index(){
        $users = users::all();
        return response()->json($users);
    }

    public function show($id){
        $users = users::find($id);
        return response()->json($users);
    }

    public function create(request $request){
        $users = new users();

        $users->id = $request->id;
        $users->name = $request->name;

        $users->save();

        return response()->json($users->id);
    }
/**    public function delete($id){
        $users = users::find($id);
        $users->delete();

        return response()->json('usuario deletado com sucesso!');
    } */
}
