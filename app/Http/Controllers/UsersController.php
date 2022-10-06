<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function view_users(){
        $users=DB::table("users")->select("*")->get();
        //return view('Users.users',compact("users"));
        return view('users.users',compact("users"));
    }

    public function agregar_users(Request $request){

        
        try {

            DB::table("users")->insert([
                "name"=> $request["nombre"],
                "email"=> $request["correo"],
                "password"=> bcrypt($request["contrasena"]),
            ]);
            
            return redirect()->back()->with(['message' => "Se Guardo correctamente el Usuario", 'color' => 'success']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
    }

    public function actualizar_users(Request $request){

        
        try {

            if ($request["contrasena"]!=null) {

                DB::table("users")->where("id",$request["id_user_edit"])->update([
                    "name"=> $request["nombre"],
                    "email"=> $request["correo"],
                    "password"=> bcrypt($request["contrasena"]),
                ]);

            }else{

                DB::table("users")->where("id",$request["id_user_edit"])->update([
                    "name"=> $request["nombre"],
                    "email"=> $request["correo"],
                ]);
            }

            
            return redirect()->back()->with(['message' => "Se Actualizo correctamente el Usuario", 'color' => 'warning']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
    }

    public function eliminar_user(Request $request){

        try {

            if ($request["id_user_edit"]!=0) {
                DB::table("users")->where("id",$request["id_user_edit"])->delete();
            }
            
            return redirect()->back()->with(['message' => "Se Elimino correctamente el Usuario", 'color' => 'danger']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }


    }
}
