<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class ServicesController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_services(){

        $vehiculos=DB::table("vehiculos")->select("*")->get();
        $ultimo_id=DB::table("servicios")->latest('id')->first();
        $services=DB::table("servicios")->select("*")->get();
        $servicio_vehiculos=DB::table("servicio_vehiculo")->select("*")->get();
        return view('Services.services',compact("vehiculos","ultimo_id","services","servicio_vehiculos"));
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

    public function actualizar_service(Request $request){

        if ($request["id_servicio_edit"]==null || $request["id_servicio_edit"]==0) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }

        try {

            DB::table("servicios")->where("id",$request["id_servicio_edit"])->update([

                "nombre"=>$request["nombre"],
                "cp"=>$request["cp"],
                "estado"=>$request["estado"],
                "colonia"=>$request["colonia"],
                "domicilio"=>$request["domicilio"],
                "telefono"=>$request["telefono"],
                "correo"=>$request["correo"],
                "observaciones"=>$request["observaciones_g"],
            ]);

            DB::table("servicio_vehiculo")->where("id_servicio",$request["id_servicio_edit"])->delete();

            for ($i=0;$i<=$request['cantidad_vehiculos'];$i++) {

                DB::table("servicio_vehiculo")->insert([

                    "id_servicio"=>$request["id_servicio_edit"],
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

            return redirect()->back()->with(['message' => "Se Actualizo correctamente el Servicio", 'color' => 'warning']);
            //echo "seguardo";
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
        
    }

    public function eliminar_service(Request $request){

        try {

            if ($request["id_servicio_edit"]!=0) {
                DB::table("servicios")->where("id",$request["id_servicio_edit"])->delete();
            }
            
            return redirect()->back()->with(['message' => "Se Elimino correctamente el Servicio", 'color' => 'danger']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }


    }

    public function pdf_service($id){

        $datos=DB::table("servicios")->where("id",$id)->first();
        $servicio_vehiculos=DB::table("servicio_vehiculo")->where("id_servicio",$id)->get();

        $pdf = PDF::loadView('Services.pdf_services',compact("datos","servicio_vehiculos"))->setPaper(array(0,0,1186,1536));
        //$nombre_pdf="Matriz Master_".$proyectos->nombre.".pdf";
        return $pdf->stream("prueba.pdf");
    }
}
