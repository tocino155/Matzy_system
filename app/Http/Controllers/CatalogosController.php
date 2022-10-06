<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSent;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;
class CatalogosController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_catalogos(){

        $vehiculos=DB::table("vehiculos")->select("*")->get();

        return view('Catalogos.vehiculos',compact('vehiculos'));
    }

    public function agregar_vehiculo(Request $request){

        
        try {

            DB::table("vehiculos")->insert([
                "matricula"=> $request["matricula"],
                "nombre"=> $request["nombre"],
                "funcion"=>$request["funcion"],
            ]);


            $data =["usuario" => Auth::user()->name,"matricula" => $request["matricula"],"nombre" => $request["nombre"],"tipo" => "nuevo","funcion" => $request["funcion"]];
            Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Nuevo Registro en Catalogos",$data,"catalogos"));
            
            return redirect()->back()->with(['message' => "Se Guardo correctamente el Vehiculo", 'color' => 'success']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
    }

    public function actualizar_vehiculo(Request $request){

        
        try {

            DB::table("vehiculos")->where("id",$request["id_vehiculo_edit"])->update([
                "matricula"=> $request["matricula"],
                "nombre"=> $request["nombre"],
                "funcion"=>$request["funcion"],
            ]);

            $data =["usuario" => Auth::user()->name,"matricula" => $request["matricula"],"nombre" => $request["nombre"],"tipo" => "actualizar","funcion" => $request["funcion"]];
            Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Registro Actualizado en Catalogos",$data,"catalogos"));
            
            return redirect()->back()->with(['message' => "Se Actualizo correctamente el Vehiculo", 'color' => 'warning']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
    }

    public function eliminar_vehiculo(Request $request){

        try {

            if ($request["id_vehiculo_edit"]!=0) {

                $vehiculo=DB::table("vehiculos")->where("id",$request["id_vehiculo_edit"])->first();
                DB::table("vehiculos")->where("id",$request["id_vehiculo_edit"])->delete();

                $data =["usuario" => Auth::user()->name,"matricula" => $vehiculo->matricula,"nombre" => $vehiculo->nombre,"tipo" => "eliminar","funcion" => $vehiculo->funcion];
                Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Registro Actualizado en Catalogos",$data,"catalogos"));
            }
            
            return redirect()->back()->with(['message' => "Se Elimino correctamente el Vehiculo", 'color' => 'danger']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }


    }
}
