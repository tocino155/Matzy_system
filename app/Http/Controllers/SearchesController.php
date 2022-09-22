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
}
