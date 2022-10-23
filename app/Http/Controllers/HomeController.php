<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_home(){

        date_default_timezone_set('America/Mexico_City');
        $ultimo_id=DB::table("servicios")->latest('id')->first();
        $ultimo_ingreso=DB::table("finanzas")->latest('id')->where("tipo","ingreso")->first();
        $ultimo_egreso=DB::table("finanzas")->latest('id')->where("tipo","egreso")->first();
        $servicios_con_ingreso=DB::table("servicios")->where("finanza","si")->get();
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

        return view('Home.home',compact("vehiculos","ultimo_id","servicios_con_ingreso","vehiculos_servicio_activo","filtro_ocupadas","servicio_vehiculos","ultimo_ingreso","ultimo_egreso"));
    }
}
