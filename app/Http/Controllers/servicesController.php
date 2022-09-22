<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ServicesController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_services(){

        $vehiculos=DB::table("vehiculos")->select("*")->get();
        $ultimo_id=DB::table("servicios")->latest('id')->first();
        return view('Services.services',compact("vehiculos","ultimo_id"));
    }

    public function agregar_service(Request $request){

        echo $request;
        
        try {

            DB::table("servicios")->insert([

                "nombre"=>$request["nombre"],
                "cp"=>$request["cp"],
                "estado"=>$request["estado"],
                "colonia"=>$request["colonia"],
                "domicilio"=>$request["domicilio"],
                "telefono"=>$request["telefono"],
                "correo"=>$request["correo"],
                "observaciones"=>$request["observaciones_g"],
            ]);

            //odtenemos el id del registro servicios para ligarlo con los vehiculos agregados
            $id = DB::getPdo()->lastInsertId();
            for ($i=0;$i<=$request['cantidad_vehiculos'];$i++) {

                DB::table("servicio_vehiculo")->insert([

                    "id_servicio"=>$id,
                    "id_vehiculo"=>$request["id_vehiculo".$i],
                    "nombre_vehiculo"=>$request["nombre_vehiculo".$i],
                    "funcion_vehiculo"=>$request["funcion".$i],
                    "matricula_vehiculo"=>$request["matricula".$i],
                    "fecha_inicio"=>$request["fecha_inicio".$i],
                    "fecha_fin"=>$request["fecha_termino".$i],
                    "horas_trabajo"=>$request["horas_trabajo".$i],
                    "mantenimiento_h"=>$request["mat_horas".$i],
                    "no_mantenimientos"=>$request["no_mantenimientos".$i],
                    "observaciones"=>$request["observaciones".$i],
                ]);
            }

            return redirect()->back()->with(['message' => "Se Guardo correctamente el Servicio", 'color' => 'success']);
            //echo "seguardo";
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
        
    }
}
