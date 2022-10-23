<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSent;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;


class ServicesController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_services(){

        date_default_timezone_set('America/Mexico_City');
        $services=DB::table("servicios")->select("*")->get();
        $ultimo_id=DB::table("servicios")->latest('id')->first();
        $servicio_vehiculos=DB::table("servicio_vehiculo")->select("*")->get();
        $i=0;
        $filtro_ocupadas=null;
        foreach ($servicio_vehiculos as $contador) {
            $filtro_ocupadas[$i]=$contador->id_vehiculo;
            $i++;
        }

       
        $vehiculos=null;
        if ($filtro_ocupadas==null) {
            $vehiculos=DB::table("vehiculos")->select("*")->get();
            $vehiculos_servicio_activo=null;
        }else{
             $vehiculos=DB::table("vehiculos")->whereNotIn("id",$filtro_ocupadas)->get();
             $vehiculos_servicio_activo=DB::table("servicio_vehiculo_registro")->whereIn("id_vehiculo",$filtro_ocupadas)->whereDate("fecha_fin","<",date("Y-m-d"))->get();
        }

        

        /*foreach ($filtro_ocupadas as $ff) {
            echo $ff."<br>";
        }
        echo "<br>";
        foreach ($vehiculos as $rr) {
            echo $rr->id."<br>";
        }
        echo "<br>";
        foreach ($vehiculos_servicio_activo as $gg) {
            echo $gg->id_vehiculo."<br>";
        }
        echo "<br>";
        */
        
        return view('Services.services',compact("vehiculos","ultimo_id","services","vehiculos_servicio_activo","filtro_ocupadas","servicio_vehiculos"));
    }

    public function agregar_service(Request $request){

        
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

                "finanza"=>"no",

            ]);

            //odtenemos el id del registro servicios para ligarlo con los vehiculos agregados
            $id = DB::getPdo()->lastInsertId();

            $contador=0;
            //este es para que se cambie y se agregue como nuevo
            for ($i=0;$i<=$request['cantidad_vehiculos'];$i++) {

                $existente=DB::table("servicio_vehiculo")->where("id_vehiculo",$request['id_vehiculo'.$i])->first();
                if ($existente != null) {
                    DB::table("servicio_vehiculo_registro")->where("id_vehiculo",$request["id_vehiculo".$i])->delete();
                    DB::table("servicio_vehiculo")->where("id_vehiculo",$request['id_vehiculo'.$i])->update([
                        "salio" => "este vehiculo ya fue elejido en otro servicio por que ya termino su fecha en este",
                    ]);
                }
            }


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

                $contador++;
            }

            for ($i=0;$i<=$request['cantidad_vehiculos'];$i++) {

                DB::table("servicio_vehiculo_registro")->insert([

                    "id_servicio"=>$id,
                    "id_vehiculo"=>$request["id_vehiculo".$i],
                    "nombre_vehiculo"=>$request["nombre_vehiculo".$i],
                    "matricula_vehiculo"=>$request["matricula".$i],
                    "fecha_inicio"=>$request["fecha_inicio".$i],
                    "fecha_fin"=>$request["fecha_termino".$i],
                ]);

            }

            $data =["usuario" => Auth::user()->name,"empresa" => $request["nombre"],"direccion" => $request["domicilio"],"cantidad" => $contador,"id_servicio" => $id,"tipo" => "nuevo"];
            Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Servicio Creado",$data,"service"));


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

            DB::table("servicio_vehiculo_registro")->where("id_servicio",$request["id_servicio_edit"])->delete();


            $contador=0;
            for ($i=0;$i<=$request['cantidad_vehiculos'];$i++) {

                $existente=DB::table("servicio_vehiculo")->where("id_vehiculo",$request['id_vehiculo'.$i])->first();
                if ($existente != null) {
                    DB::table("servicio_vehiculo_registro")->where("id_vehiculo",$request["id_vehiculo".$i])->delete();
                    DB::table("servicio_vehiculo")->where("id_vehiculo",$request['id_vehiculo'.$i])->update([
                        "salio" => "este vehiculo ya fue elejido en otro servicio por que ya termino su fecha en este",
                    ]);
                }
            }

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

                $contador++;
            }

            for ($i=0;$i<=$request['cantidad_vehiculos'];$i++) {

                DB::table("servicio_vehiculo_registro")->insert([
                    "id_servicio"=>$request["id_servicio_edit"],
                    "id_vehiculo"=>$request["id_vehiculo".$i],
                    "nombre_vehiculo"=>$request["nombre_vehiculo".$i],
                    "matricula_vehiculo"=>$request["matricula".$i],
                    "fecha_inicio"=>$request["fecha_inicio".$i],
                    "fecha_fin"=>$request["fecha_termino".$i],
                ]);

            }

            $data =["usuario" => Auth::user()->name,"empresa" => $request["nombre"],"direccion" => $request["domicilio"],"cantidad" => $contador,"id_servicio" => $request["id_servicio_edit"],"tipo" => "actualizar"];
            Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Servicio Actualizado",$data,"service"));


            return redirect()->back()->with(['message' => "Se Actualizo correctamente el Servicio", 'color' => 'warning']);
            //echo "seguardo";
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
        
    }

    public function eliminar_service(Request $request){

        try {

            if ($request["id_servicio_edit"]!=0) {

                $service_data=DB::table("servicios")->where("id",$request["id_servicio_edit"])->first();
                DB::table("servicios")->where("id",$request["id_servicio_edit"])->delete();

                $data =["usuario" => Auth::user()->name,"empresa" => $service_data->nombre,"direccion" => $service_data->domicilio,"cantidad" => "0","id_servicio" => $service_data->id,"tipo" => "eliminar"];
                Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Servicio Eliminado",$data,"service"));

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

        return $pdf->stream("folio_CMZ-".$id.".pdf");
    }
    public function envio(){

        $data =["usuario" => Auth::user()->name,"empresa" => "nombre empresa","direccion" => "direccion","cantidad" => "numero","id_servicio" => "1","tipo" => "actualizar"];
        Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Servicio Creado",$data,"service"));

        return $pdf->stream("prueba.pdf");

    }
}
