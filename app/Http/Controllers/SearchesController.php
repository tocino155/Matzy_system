<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SearchesController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function search_user($id){

        $user_data=DB::table("users")->where("id",$id)->first();
        return json_encode($user_data);
    }

    public function search_vehiculo($id){

        $vehiculo_data=DB::table("vehiculos")->where("id",$id)->first();
        return json_encode($vehiculo_data);
    }

    public function search_cp($cp){

        $cp_data=DB::table("cat_estados")->where("cp",$cp)->get();
        return json_encode($cp_data);
    }

    public function search_service($id){
        $service_data=DB::table("servicios")->where("id",$id)->first();
        return json_encode($service_data);
    }

    public function search_service_vehiculo($id_servicio){
        $servicio_vehiculos_data=DB::table("servicio_vehiculo")->where("id_servicio",$id_servicio)->get();
        return json_encode($servicio_vehiculos_data);
    }

    public function search_vehiculos(){
        $vehiculos_data=DB::table("vehiculos")->get();
        return json_encode($vehiculos_data);
    }

    public function search_vehiculos_filtrados(){

        date_default_timezone_set('America/Mexico_City');
        $servicio_vehiculos=DB::table("servicio_vehiculo_registro")->select("*")->get();
        $i=0;
        $filtro_ocupadas=null;
        foreach ($servicio_vehiculos as $contador) {
            $filtro_ocupadas[$i]=$contador->id_vehiculo;
            $i++;
        }

       //esto es para obtener los ids de los registros
        $vehiculos_servicio_activo=null;
        if ($filtro_ocupadas==null) {
            $vehiculos=DB::table("vehiculos")->select("*")->get();
            
        }else{
            //usamos wherenotin para que solo jale los registros que no estan en el arreglo de ids
             $vehiculos=DB::table("vehiculos")->whereNotIn("id",$filtro_ocupadas)->get();
             //vemos que vehiculos ya terminaron su fecha pactada en el servicio
            $vehiculos_servicio_activo=DB::table("servicio_vehiculo_registro")->whereIn("id_vehiculo",$filtro_ocupadas)->whereDate("fecha_fin","<",date("Y-m-d"))->get();
        }
        

        //ahora sacamos los vehiculos otra vez pero estos son los que tienen servicio pero ya termino la fecha 
        $i=0;
        $filtro_ocupadas2=null;
        if ($vehiculos_servicio_activo != null) {

            foreach ($vehiculos_servicio_activo as $contador) {
                echo $i."-";
                $filtro_ocupadas2[$i]=$contador->id_vehiculo;
                $i++;

            }

        }
        

        if ($filtro_ocupadas2==null) {
            //ocupe la misma variable puesto que ya la use y los datos que tenian ya no me eran utiles
            $vehiculos_servicio_activo=null;
        }else{
             $vehiculos_servicio_activo=DB::table("vehiculos")->whereIn("id",$filtro_ocupadas2)->get();
        }

        $vehiculos_filtrado[0]=$vehiculos;
        $vehiculos_filtrado[1]=$vehiculos_servicio_activo;        


        //$vehiculos_services=DB::table("servicio_vehiculo")->get();
        return json_encode($vehiculos_filtrado);
    }

    public function search_vehiculos_filtrados_edit($id_servicio){

        date_default_timezone_set('America/Mexico_City');
        $servicio_vehiculos=DB::table("servicio_vehiculo_registro")->select("*")->get();
        $i=0;
        $filtro_ocupadas=null;
        foreach ($servicio_vehiculos as $contador) {
            $filtro_ocupadas[$i]=$contador->id_vehiculo;
            $i++;
        }

       //esto es para obtener los ids de los registros
        if ($filtro_ocupadas==null) {
            $vehiculos=DB::table("vehiculos")->select("*")->get();
        }else{
            //usamos wherenotin para que solo jale los registros que no estan en el arreglo de ids
             $vehiculos=DB::table("vehiculos")->whereNotIn("id",$filtro_ocupadas)->get();
        }
        //vemos que vehiculos ya terminaron su fecha pactada en el servicio
        $vehiculos_servicio_activo=DB::table("servicio_vehiculo_registro")->whereIn("id_vehiculo",$filtro_ocupadas)->whereDate("fecha_fin","<",date("Y-m-d"))->get();

        //ahora sacamos los vehiculos otra vez pero estos son los que tienen servicio pero ya termino la fecha 
        $i=0;
        $filtro_ocupadas2=null;
        foreach ($vehiculos_servicio_activo as $contador) {

            $filtro_ocupadas2[$i]=$contador->id_vehiculo;
            $i++;
        }

        if ($filtro_ocupadas2==null) {
            //ocupe la misma variable puesto que ya la use y los datos que tenian ya no me eran utiles
            $vehiculos_servicio_activo=null;
        }else{
             $vehiculos_servicio_activo=DB::table("vehiculos")->whereIn("id",$filtro_ocupadas2)->get();
        }

        //este filtro es para saber cuales son del servicio y aparezcan 
        $i=0;
        $filtro_ocupadas3=null;
        if ($vehiculos_servicio_activo !=null) {

            foreach ($vehiculos_servicio_activo as $contador) {
 
                $filtro_ocupadas3[$i]=$contador->id;
                $i++;
            }
            
        }
        

        if ($filtro_ocupadas3==null) {
            //
            $vehiculos_servicio_propio=DB::table("servicio_vehiculo_registro")->where("id_servicio",$id_servicio)->get();
        }else{
             $vehiculos_servicio_propio=DB::table("servicio_vehiculo_registro")->whereNotIn("id_vehiculo",$filtro_ocupadas3)->where("id_servicio",$id_servicio)->get();
        }

   


        $vehiculos_filtrado_edit[0]=$vehiculos;
        $vehiculos_filtrado_edit[1]=$vehiculos_servicio_activo;
        //este no sirve pero no son los datos del vehiculo son de la tabla servico vehiculo que nos da tambien su id del vehiculo y la matricula y mas datos        
        $vehiculos_filtrado_edit[2]=$vehiculos_servicio_propio;

        //$vehiculos_services=DB::table("servicio_vehiculo")->get();
        return json_encode($vehiculos_filtrado_edit);
    }
}
