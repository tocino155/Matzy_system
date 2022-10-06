<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSent;
//esta es para poder acceder a los datos del usuario
use Illuminate\Support\Facades\Auth;
class FinanceController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function view_finance(){

        $services=DB::table("servicios")->select("*")->get();
        $finanzas=DB::table("finanzas")->select("*")->get();
        return view('Finance.finance',compact("services","finanzas"));
    }

    public function dar_alta_finanza(Request $request){

        try {

            DB::table("servicios")->where("id",$request["folio"])->update([
                "finanza"=>"si",
            ]);

            $service_data=DB::table("servicios")->where("id",$request["folio"])->first();

            $data =["usuario" => Auth::user()->name,"empresa" => $service_data->nombre,"id_servicio" => $service_data->id,"tipo" => "nuevo","total" => "0","cantidad" => "0"];
            Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Presupuesto Creado",$data,"finance"));

            return redirect()->back()->with(['message' => "Se creo la finanza correctamente", 'color' => 'success']);
            //echo "seguardo";
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
    }

    public function agregar_presupuesto(Request $request){

        $contador=0;
        $total=0;
        try {
            
            foreach ($request["concepto"] as $clave => $dato) {
                DB::table("finanzas")->insert([
                    "id_servicio"=>$request["id_servicio"],
                    "concepto"=>$request["concepto"][$clave],
                    "cantidad"=>$request["cantidad"][$clave],
                    "tipo"=>$request["tipo"],
                    "observaciones"=>$request["observaciones"][$clave],
                ]);
                $contador++;
                $total+=$request["cantidad"][$clave];
            }

            $service_data=DB::table("servicios")->where("id",$request["id_servicio"])->first();

            if ($request["tipo"]=="ingreso") {

                $data =["usuario" => Auth::user()->name,"empresa" => $service_data->nombre,"id_servicio" => $service_data->id,"tipo" => "ingreso","total" => $total,"cantidad" => $contador];
                Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Ingreso Registrado",$data,"finance"));

                return redirect()->back()->with(['message' => "Se agrego el ingreso correctamente", 'color' => 'success']);
            }else{

                $data =["usuario" => Auth::user()->name,"empresa" => $service_data->nombre,"id_servicio" => $service_data->id,"tipo" => "egreso","total" => $total,"cantidad" => $contador];
                Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Egreso Registrado",$data,"finance"));


                return redirect()->back()->with(['message' => "Se agrego el egreso correctamente", 'color' => 'success']);
            }
            
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
    }

    public function eliminar_finance(Request $request){

        try {

            if ($request["id_servicio_edit"]!=0) {
                DB::table("finanzas")->where("id_servicio",$request["id_servicio_edit"])->delete();
                DB::table("servicios")->where("id",$request["id_servicio_edit"])->update([
                    "finanza"=>"no",
                ]);

                $service_data=DB::table("servicios")->where("id",$request["id_servicio_edit"])->first();

                $data =["usuario" => Auth::user()->name,"empresa" => $service_data->nombre,"id_servicio" => $service_data->id,"tipo" => "eliminar","total" => "0","cantidad" => "0"];
                Mail::to("nuckelavee95@gmail.com")->send(new MessageSent("Presupuesto Eliminado",$data,"finance"));

            }


            
            return redirect()->back()->with(['message' => "Se Elimino correctamente el Presupuesto", 'color' => 'danger']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => "Algo salio mal con la base de datos, intente de nuevo", 'color' => 'warning']);
        }
    }

    public function pdf_finance($id){

        $datos=DB::table("servicios")->where("id",$id)->first();
        $servicio_vehiculos=DB::table("servicio_vehiculo")->where("id_servicio",$id)->get();
        $finanzas=DB::table("finanzas")->where("id_servicio",$id)->get();
        $pdf = PDF::loadView('Finance.pdf_finance',compact("datos","servicio_vehiculos","finanzas"))->setPaper(array(0,0,1186,1536));
        //$nombre_pdf="Matriz Master_".$proyectos->nombre.".pdf";
        return $pdf->stream("folio_CMZ-".$id.".pdf");
    }
}
