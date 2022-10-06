@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
<!--este es para el selected2 -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
@stop

@section('content')

<style type="text/css">
    .marca{
        transition: 1s;
    }
    .marca:hover{
        background: #DBDBDB;
        transition: 1s;
    }

    .visible_on{
        display: block;
        position: fixed;
        background: white;
        border-radius: 15px;
        width: auto;
    }
    .visible_off{
        display: none;
    }
    .paginate_button{

        position: sticky;
    }

</style>

<div>
    <h3>Servicios</h3>
</div>

@if (Session::has('message'))

@if(Session::get('message')== "Algo salio mal con la base de datos, intente de nuevo")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16">
          <path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/>
          <path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/>
          <path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/>
        </svg> &nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif
@if(Session::get('message')== "Se Guardo correctamente el Servicio")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
          <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
          <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
        </svg>&nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif

@if(Session::get('message')== "Se Actualizo correctamente el Servicio")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
          <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
          <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
        </svg> &nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif

@if(Session::get('message')== "Se Elimino correctamente el Servicio")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-journal-x" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707 6.854 9.854a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z"/>
          <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
          <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
        </svg> &nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif
    
@endif



<div class="card">
    <div class="card-body">
        <div style="margin-bottom: 20px;">
            <button class="btn" style="background-color: #F5B32B" data-toggle="modal" data-target="#agregar" >Agregar</button>
        </div>
        <div class="table-responsive">

            <table class="table" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">Folio</th>
                        <th style="text-align: center;">No. Vehiculos</th>
                        <th style="text-align: center;">Cliente</th>
                        <th style="text-align: center;">F. Inicio</th>
                        <th style="text-align: center;">F. Termino</th>
                        <th style="text-align: center;">Estatus</th>
                                                
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr class="marca" onclick="pasar_id({{$service->id}})">
                        <td style="text-align: center;">
                            CMZ-{{$service->id}}
                        </td>
                        <td style="text-align: center;">
                            <?php $contador=0; ?>
                            @foreach($servicio_vehiculos as $servicio_vehiculo)
                            @if($servicio_vehiculo->id_servicio==$service->id)
                            <?php $contador++; ?>
                            @endif
                            @endforeach
                            {{$contador}}
                        </td>
                        <td style="text-align: center;">
                            {{$service->nombre}}
                        </td>
                        <td style="text-align: center;">
                            ---
                        </td>
                        <td style="text-align: center;">
                            ---
                        </td>
                        <td style="text-align: center;">
                            espera
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>

    </div>
</div>


<!-- modal de agregar servicio-->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form action="{{ url('/guardar_servicio') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9" style="margin-bottom: 10px;">
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Folio</label>
                        <input style="font-weight: bold; font-size: 20px;" type="text" name="folio" class="form-control" id="folio" onkeyup="activar_envio();" value="CMZ-<?php if($ultimo_id==null){echo 1;}else{echo $ultimo_id->id+1;} ?>" required disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <label style="color: #888888;">Datos del Cliente</label>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label >Nombre / Empresa</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" onkeyup="activar_envio();" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>C.P</label>
                        <input type="text" name="cp" class="form-control" id="cp" onkeyup="activar_envio(); if(this.value.length>=5){buscar_cp(this.value);}" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Estado</label>
                        <input type="text" name="estado" class="form-control" id="estado" onkeyup="activar_envio();" required readonly>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Colonia</label>
                        <select name="colonia" class="form-control" id="colonia" onkeyup="activar_envio();" required>
                            
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <label>Domicilio</label>
                        <input type="text" name="domicilio" class="form-control" id="domicilio" onkeyup="activar_envio();" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Telefono</label>
                        <input type="text" name="telefono" class="form-control" id="telefono" onkeyup="activar_envio();" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Correo</label>
                        <input type="text" name="correo" class="form-control" id="correo" onkeyup="activar_envio();" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <label style="color: #888888;">Datos del Vehiculo</label>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Matricula del Vehiculo</label>
                        <select name="id_vehiculo0" class="form-control" id="id_vehiculo0" onchange="activar_envio(); pasar_datos_vehiculo(this.value,0);" required>
                            <option value="" disabled selected>.:Selecciona:.</option>
                            @foreach($vehiculos as $vehiculo)
                            <option value="{{$vehiculo->id}}">{{$vehiculo->matricula}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Nombre</label>
                        <input type="text" name="nombre_vehiculo0" id="nombre_vehiculo0" class="form-control" onkeyup="activar_envio();" required readonly>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Funcion</label>
                        <input type="text" name="funcion0" id="funcion0" class="form-control" onkeyup="activar_envio();" required readonly>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label></label><br>
                        <button type="button" class="btn btn-success" style="margin-top: 8px; width: 100%;" onclick="agregar_prueba();"> Agregar Vehiculo</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <label style="color: #888888;">Datos del Servicio</label>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Matricula del Vehiculo</label>
                        <input type="text" name="matricula0" id="matricula0" class="form-control" onkeyup="activar_envio();" required readonly>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Fecha de inicio</label>
                        <input type="date" name="fecha_inicio0" id="fecha_inicio0" class="form-control" onchange="activar_envio(); diferecia_dias(0);" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Fecha de Termino</label>
                        <input type="date" name="fecha_termino0" id="fecha_termino0" class="form-control" onchange="activar_envio(); diferecia_dias(0);" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Horas de Trabajo</label>
                        <input type="text" name="horas_trabajo0" id="horas_trabajo0" class="form-control" onkeyup="activar_envio();" required readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Mant. después de (Hrs)</label>
                        <input type="number" name="mat_horas0" id="mat_horas0" class="form-control" onkeyup="activar_envio(); mantenimiento_horas(0);" onchange="activar_envio(); mantenimiento_horas(0);" required min="1">
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>No. Mantenimientos</label>
                        <input type="text" name="no_mantenimientos0" id="no_mantenimientos0" class="form-control" onchange="activar_envio();" required readonly>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <label>Observacines</label>
                        <textarea name="observaciones0" id="observaciones0" class="form-control" rows="1" onkeyup="activar_envio();" ></textarea>
                    </div>
                </div>

                <div id="contenedor_padre">

                </div>
                <div class="col-md-12" style="margin-bottom: 10px;">
                    <label>Observaciones Generales</label>
                    <textarea name="observaciones_g" class="form-control" onkeyup="activar_envio();" ></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="cantidad_vehiculos" id="cantidad_vehiculos">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button class="btn" disabled id="envio_button">Aceptar</button>
            </div>
        </form>
    </div>
  </div>
</div>


<!--menu de opciones de la tabla-->
<div id="menu_opciones" class="visible_off " style=" padding: 20px; background-color: #858585bd;">

    <button type="button" class="close" style="margin-right: -17px; margin-top: -20px; " onclick="cerrar_menu();">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
            <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
    </button>
    <button class="btn btn-danger" style="margin-bottom: 10px; font-weight: bold; margin-top: 10px; width: 100%;" data-toggle="modal" data-target="#eliminar_registro" onclick="eliminar_registro();" >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
        </svg>
        Eliminar
    </button>
    <br>
    <button class="btn btn-warning" style="margin-bottom: 10px; font-weight: bold; width: 100%;" data-toggle="modal" data-target="#editar_registro" onclick="editar_registro();">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
        </svg>
        Editar
    </button>

    <button class="btn btn-info" style="margin-bottom: 10px; font-weight: bold; width: 100%;" data-toggle="modal" data-target="#pdf" onclick="document.getElementById('visor_pdf').src='/PDF_servicio/'+id_servicio;" >
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
        </svg>
        PDF
    </button>
</div>

<!-- modal de Editar servicio-->
<div class="modal fade" id="editar_registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form action="{{ url('/Actualizar_servicio') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9" style="margin-bottom: 10px;">
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Folio</label>
                        <input style="font-weight: bold; font-size: 20px;" type="text" name="folio_edit" class="form-control" id="folio_edit" onkeyup="activar_envio_2();" value="CMZ-<?php if($ultimo_id==null){echo 1;}else{echo $ultimo_id->id+1;} ?>" required disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <label style="color: #888888;">Datos del Cliente</label>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label >Nombre / Empresa</label>
                        <input type="text" name="nombre" class="form-control" id="nombre_edit" onkeyup="activar_envio();" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>C.P</label>
                        <input type="text" name="cp" class="form-control" id="cp_edit" onkeyup="activar_envio_2(); if(this.value.length>=5){buscar_cp_2(this.value);}" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Estado</label>
                        <input type="text" name="estado" class="form-control" id="estado_edit" onkeyup="activar_envio_2();" required readonly>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Colonia</label>
                        <select name="colonia" class="form-control" id="colonia_edit" onkeyup="activar_envio_2();" required>
                            
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <label>Domicilio</label>
                        <input type="text" name="domicilio" class="form-control" id="domicilio_edit" onkeyup="activar_envio_2();" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Telefono</label>
                        <input type="text" name="telefono" class="form-control" id="telefono_edit" onkeyup="activar_envio_2();" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Correo</label>
                        <input type="text" name="correo" class="form-control" id="correo_edit" onkeyup="activar_envio_2();" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <label style="color: #888888;">Datos del Vehiculo</label>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Matricula del Vehiculo</label>
                        <select name="id_vehiculo0" class="form-control" id="id_vehiculo_edit0" onchange="activar_envio_2(); pasar_datos_vehiculo_2(this.value,0);" required>

                            <option value="" disabled selected>.:Selecciona:.</option>
                            @foreach($vehiculos as $vehiculo)
                            <option value="{{$vehiculo->id}}">{{$vehiculo->matricula}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Nombre</label>
                        <input type="text" name="nombre_vehiculo0" id="nombre_vehiculo_edit0" class="form-control" onkeyup="activar_envio_2();" required readonly>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Funcion</label>
                        <input type="text" name="funcion0" id="funcion_edit0" class="form-control" onkeyup="activar_envio_2();" required readonly>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label></label><br>
                        <button type="button" class="btn btn-success" style="margin-top: 8px; width: 100%;" onclick="agregar_prueba_2();"> Agregar Vehiculo</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <label style="color: #888888;">Datos del Servicio</label>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Matricula del Vehiculo</label>
                        <input type="text" name="matricula0" id="matricula_edit0" class="form-control" onkeyup="activar_envio_2();" required readonly>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Fecha de inicio</label>
                        <input type="date" name="fecha_inicio0" id="fecha_inicio_edit0" class="form-control" onchange="activar_envio_2(); diferecia_dias_2(0);" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Fecha de Termino</label>
                        <input type="date" name="fecha_termino0" id="fecha_termino_edit0" class="form-control" onchange="activar_envio_2(); diferecia_dias_2(0);" required>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Horas de Trabajo</label>
                        <input type="text" name="horas_trabajo0" id="horas_trabajo_edit0" class="form-control" onkeyup="activar_envio_2();" required readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>Mant. después de (Hrs)</label>
                        <input type="number" name="mat_horas0" id="mat_horas_edit0" class="form-control" onkeyup="activar_envio(); mantenimiento_horas_2(0);" onchange="activar_envio_2(); mantenimiento_horas_2(0);" required min="1">
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <label>No. Mantenimientos</label>
                        <input type="text" name="no_mantenimientos0" id="no_mantenimientos_edit0" class="form-control" onchange="activar_envio_2();" required readonly>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <label>Observacines</label>
                        <textarea name="observaciones0" id="observaciones_edit0" class="form-control" rows="1" onkeyup="activar_envio_2();" ></textarea>
                    </div>
                </div>

                <div id="contenedor_padre_edit">

                </div>
                <div class="col-md-12" style="margin-bottom: 10px;">
                    <label>Observaciones Generales</label>
                    <textarea name="observaciones_g" id="observaciones_edit_edit" class="form-control" onkeyup="activar_envio_2();" ></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_servicio_edit" id="id_servicio_edit">
                <input type="hidden" name="cantidad_vehiculos" id="cantidad_vehiculos_edit">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button class="btn " disabled id="envio_button_2">Actualizar</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- modal de eliminar usuario-->
<div class="modal fade" id="eliminar_registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar Servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form action="{{ url('/Eliminar_servicio') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <label style="font-weight: bold; font-size: 25px;">¿Seguro que quieres eliminar al servicio?</label><br><br>
                <div style="text-align: center;">

                    <label style=" font-weight: bold; font-size: 25px;" >Folio: </label>
                    <label style="color: red; font-weight: bold; font-size: 25px;" id="text_folio"></label><br>
                    
                    <label style=" font-weight: bold; font-size: 25px;" >Cliente: </label>
                    <label style="color: red; font-weight: bold; font-size: 25px;" id="text_cliente"></label>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_servicio_edit" id="id_servicio_edit_2">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger" >Eliminar</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- modal de eliminar usuario-->
<div class="modal fade" id="pdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ver PDF</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">

            <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira">
                <p>UPss! &nbsp;&nbsp; !CREO QUE NO SE VE BIEN EL PDF; VAMOS A OTRA PAGINA OK!</p>
                <a class="btn btn-success" target="_blank" href="{{url('/Visor_PDF')}}">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
            </div>
            <embed type="application/pdf" src="" style="width:100%; height: 600px;" id="visor_pdf">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

@stop

@section('css')

@stop

@section('js')
<!-- estos son para la tabla-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js">
</script>
<!-- este es para el selected2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
    
    $(document).ready(function() {
        $('.table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });

    
    function activar_envio(){

        if (document.getElementById("nombre").value!=""&& document.getElementById("cp").value!=""&& document.getElementById("estado").value!=""&& document.getElementById("colonia").value!=""&& document.getElementById("domicilio").value!=""&& document.getElementById("telefono").value!=""&& document.getElementById("correo").value!="") {

            var aux=j-contador;
            console.log(aux);
            for (var i = 0; i < j; i++) {
                try{

                    if (document.getElementById("id_vehiculo"+i).value!="" && document.getElementById("nombre_vehiculo"+i).value!=""&& document.getElementById("funcion"+i).value!="" && document.getElementById("matricula"+i).value!="" && document.getElementById("fecha_inicio"+i).value!="" && document.getElementById("fecha_termino"+i).value!="" && document.getElementById("horas_trabajo"+i).value>0 && document.getElementById("mat_horas"+i).value>0 && document.getElementById("no_mantenimientos"+i).value>0) {

                        document.getElementById("envio_button").classList.add("btn-success");
                        document.getElementById("envio_button").disabled = false;

                    } else {
                        document.getElementById("envio_button").classList.remove("btn-success");
                        document.getElementById("envio_button").disabled = true;
                        break;
                    }

                }catch (TypeError) {
                  console.log("no existe ese objeto con ese nombre");
                }
            }
            
        }else{
            document.getElementById("envio_button").classList.remove("btn-success");
            document.getElementById("envio_button").disabled = true;
        }
    }

    //esta es la mimsa de que otra pero esta es para la de editar
    function activar_envio_2(){

        if (document.getElementById("nombre_edit").value!=""&& document.getElementById("cp_edit").value!=""&& document.getElementById("estado_edit").value!=""&& document.getElementById("colonia_edit").value!=""&& document.getElementById("domicilio_edit").value!=""&& document.getElementById("telefono_edit").value!=""&& document.getElementById("correo_edit").value!="") {

            for (var i = 0; i < j_2; i++) {
                try{

                    if (document.getElementById("id_vehiculo_edit"+i).value!="" && document.getElementById("nombre_vehiculo_edit"+i).value!=""&& document.getElementById("funcion_edit"+i).value!="" && document.getElementById("matricula_edit"+i).value!="" && document.getElementById("fecha_inicio_edit"+i).value!="" && document.getElementById("fecha_termino_edit"+i).value!="" && document.getElementById("horas_trabajo_edit"+i).value>0 && document.getElementById("mat_horas_edit"+i).value>0 && document.getElementById("no_mantenimientos_edit"+i).value>0) {

                        document.getElementById("envio_button_2").classList.add("btn-warning");
                        document.getElementById("envio_button_2").disabled = false;

                    } else {
                        document.getElementById("envio_button_2").classList.remove("btn-warning");
                        document.getElementById("envio_button_2").disabled = true;
                        break;
                    }

                }catch (TypeError) {
                  console.log("no existe ese objeto con ese nombre");
                }
            }
            
        }else{
            document.getElementById("envio_button_2").classList.remove("btn-success");
            document.getElementById("envio_button_2").disabled = true;
        }
    }

    var id_servicio=null;

    function pasar_id($id_tr) {
        id_servicio=$id_tr;
        var coordenadas_y=event.clientY; //odtenemos el valor de la posicion del boton
        var coordenadas_x=event.clientX; //odtenemos el valor de la posicion del boton
        menu_opciones.style.top=coordenadas_y-50+"px";
        menu_opciones.style.left=coordenadas_x-50+"px";
        menu_opciones.classList.add("visible_on");
        menu_opciones.classList.remove("visible_off");
      //alert($id_tr);
    }

    menu_opciones.addEventListener("mouseleave",function(){
          menu_opciones.classList.remove("visible_on");
          menu_opciones.classList.add("visible_off");
    });

    function cerrar_menu(){
        menu_opciones.classList.remove("visible_on");
        menu_opciones.classList.add("visible_off");
    }

    function editar_registro(){
        $("#colonia_edit").empty();
        $("#contenedor_padre_edit").empty();
        $("#observaciones_edit_edit").empty();
        j_2=1;
        contador_2=0;
        $.ajax({
          url: "{{url('/get_servicios')}}"+'/'+id_servicio,
          dataType: "json",
          //context: document.body
        }).done(function(service_data) {
            if(service_data==null){
                document.getElementById("folio_edit").value=null
                document.getElementById("nombre_edit").value=null;
                document.getElementById("cp_edit").value=null;
                document.getElementById("estado_edit").value=null;
                $("#colonia_edit").empty();
                document.getElementById("domicilio_edit").value=null;
                document.getElementById("telefono_edit").value=null;
                document.getElementById("correo_edit").value=null;
                document.getElementById("id_servicio_edit").value=null;
                $("#observaciones_edit_edit").empty();
            }else{

                document.getElementById("folio_edit").value="CMZ-"+service_data.id;
                document.getElementById("nombre_edit").value=service_data.nombre;
                document.getElementById("cp_edit").value=service_data.cp;
                document.getElementById("estado_edit").value=service_data.estado;
                $("#colonia_edit").append('<option value="'+service_data.colonia+'">'+service_data.colonia+'</option>');
                document.getElementById("domicilio_edit").value=service_data.domicilio;
                document.getElementById("telefono_edit").value=service_data.telefono;
                document.getElementById("correo_edit").value=service_data.correo;
                document.getElementById("id_servicio_edit").value=service_data.id;
                $("#observaciones_edit_edit").append(service_data.observaciones);
                $.ajax({
                  url: "{{url('/get_servicio_vehiculos')}}"+'/'+service_data.id,
                  dataType: "json",
                  //context: document.body
                }).done(function(servicio_vehiculos_data) {

                    if(servicio_vehiculos_data==null){

                        $("#contenedor_padre_edit").empty();
                        j_2=1;
                        contador_2=0;

                    }else{
                        
                        for(var i=0;i<servicio_vehiculos_data.length;i++){

                            if(i==0){

                                document.getElementById("nombre_vehiculo_edit0").value=servicio_vehiculos_data[i].nombre_vehiculo;
                                document.getElementById("id_vehiculo_edit0").value=servicio_vehiculos_data[i].id_vehiculo;
                                document.getElementById("funcion_edit0").value=servicio_vehiculos_data[i].funcion_vehiculo;
                                document.getElementById("matricula_edit0").value=servicio_vehiculos_data[i].matricula_vehiculo;
                                document.getElementById("fecha_inicio_edit0").value=servicio_vehiculos_data[i].fecha_inicio;
                                document.getElementById("fecha_termino_edit0").value=servicio_vehiculos_data[i].fecha_fin;
                                document.getElementById("horas_trabajo_edit0").value=servicio_vehiculos_data[i].horas_trabajo;
                                document.getElementById("mat_horas_edit0").value=servicio_vehiculos_data[i].mantenimiento_h;
                                document.getElementById("no_mantenimientos_edit0").value=servicio_vehiculos_data[i].no_mantenimientos;
                                $("#observaciones_edit0").append(servicio_vehiculos_data[i].observaciones);

                            }else{

                                if(j_2>0){

                                    $("#contenedor_padre_edit").append(

                                        '<div id="contenedor_hijo_edit'+j_2+'">'+
                                            
                                            '<div class="row">'+
                                                '<div class="col-md-12" style="margin-bottom: 10px;">'+
                                                    '<label style="color: #888888;">Datos del Vehiculo</label>'+
                                                '</div>'+
                                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>Matricula del Vehiculo</label>'+
                                                    '<select name="id_vehiculo'+j_2+'" class="form-control" id="id_vehiculo_edit'+j_2+'" onchange="activar_envio_2(); pasar_datos_vehiculo_2(this.value,'+j_2+');" required>'+
                                                        '<option value="" disabled >.:Selecciona:.</option>'+
                                                        '@foreach($vehiculos as $vehiculo)'+
                                                        '<option value="{{$vehiculo->id}}">{{$vehiculo->matricula}}</option>'+
                                                        '@endforeach'+
                                                    '</select>'+
                                                '</div>'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>Nombre</label>'+
                                                    '<input type="text" name="nombre_vehiculo'+j_2+'" value="'+servicio_vehiculos_data[i].nombre_vehiculo+'" id="nombre_vehiculo_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2();" required readonly>'+
                                                '</div>'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>Funcion</label>'+
                                                    '<input type="text" name="funcion'+j_2+'" value="'+servicio_vehiculos_data[i].funcion_vehiculo+'" id="funcion_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2();" required readonly>'+
                                                '</div>'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label></label><br>'+
                                                    '<button type="button" class="btn btn-danger eliminar_hijo_edit" style="margin-top: 8px; width: 100%;" id="'+j_2+'"> eliminar </button>'+
                                                '</div>'+
                                            '</div>'+

                                            '<div class="row">'+
                                                '<div class="col-md-12" style="margin-bottom: 10px;">'+
                                                    '<label style="color: #888888;">Datos del Servicio</label>'+
                                                '</div>'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>Matricula del Vehiculo</label>'+
                                                    '<input type="text" name="matricula'+j_2+'" value="'+servicio_vehiculos_data[i].matricula_vehiculo+'" id="matricula_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2();" required readonly>'+
                                                '</div>'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>Fecha de inicio</label>'+
                                                    '<input type="date" name="fecha_inicio'+j_2+'" value="'+servicio_vehiculos_data[i].fecha_inicio+'" id="fecha_inicio_edit'+j_2+'" class="form-control" onchange="activar_envio_2(); diferecia_dias_2('+j_2+');" required>'+
                                                '</div>'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>Fecha de Termino</label>'+
                                                    '<input type="date" name="fecha_termino'+j_2+'" value="'+servicio_vehiculos_data[i].fecha_fin+'" id="fecha_termino_edit'+j_2+'" class="form-control" onchange="activar_envio_2(); diferecia_dias_2('+j_2+');" required>'+
                                                '</div>'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>Horas de Trabajo</label>'+
                                                    '<input type="text" name="horas_trabajo'+j_2+'" value="'+servicio_vehiculos_data[i].horas_trabajo+'" id="horas_trabajo_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2();" required readonly>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>Mant. después de (Hrs)</label>'+
                                                    '<input type="number" name="mat_horas'+j_2+'" value="'+servicio_vehiculos_data[i].mantenimiento_h+'" id="mat_horas_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2(); mantenimiento_horas_2('+j_2+');" onchange="activar_envio_2(); mantenimiento_horas_2('+j_2+');" required min="1">'+
                                                '</div>'+
                                                '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                                    '<label>No. Mantenimientos</label>'+
                                                    '<input type="text" name="no_mantenimientos'+j_2+'" value="'+servicio_vehiculos_data[i].no_mantenimientos+'" id="no_mantenimientos_edit'+j_2+'" class="form-control" onchange="activar_envio_2();" required readonly>'+ 
                                                '</div>'+
                                                '<div class="col-md-6" style="margin-bottom: 10px;">'+
                                                    '<label>Observacines</label>'+
                                                    '<textarea name="observaciones'+j_2+'" id="observaciones_edit'+j_2+'" class="form-control" rows="1" onkeyup="activar_envio_2();" >'+servicio_vehiculos_data[i].observaciones+'</textarea>'+
                                                '</div>'+
                                            '</div>'+

                                        '</div>'

                                    );
                                    document.getElementById("id_vehiculo_edit"+j_2).value=servicio_vehiculos_data[i].id_vehiculo;
                                    j_2++;
                                    contador_2++;

                                }

                            }


                            
                            //console.log(contador);
                            document.getElementById("cantidad_vehiculos_edit").value=contador_2;
                            activar_envio_2();


                        }

                    }

                });
            }

        });

    }

    function eliminar_registro(){

        $.ajax({
          url: "{{url('/get_servicios')}}"+'/'+id_servicio,
          dataType: "json",
          //context: document.body
        }).done(function(service_data) {
            if(service_data==null){
                document.getElementById("text_folio").innerHTML=null;
                document.getElementById("id_servicio_edit_2").value=null;
                document.getElementById("text_cliente").innerHTML=null;
            }else{
                document.getElementById("text_folio").innerHTML="CMZ-"+service_data.id;
                document.getElementById("id_servicio_edit_2").value=service_data.id;
                document.getElementById("text_cliente").innerHTML=service_data.nombre;
            }

        });

    }

    function buscar_cp(cp){

        $.ajax({
          url: "{{url('/get_cp')}}"+'/'+cp,
          dataType: "json",
          //context: document.body
        }).done(function(cp_data) {
            document.getElementById("estado").value=null;
            $("#colonia").empty();
            if(cp_data==null){
                document.getElementById("estado").value=null;
                $("#colonia").empty();
            }else{
                document.getElementById("estado").value=cp_data[0].estado;
                for(var i=0;i<cp_data.length;i++){
                    $("#colonia").append('<option value="'+cp_data[i].colonia+'">'+cp_data[i].colonia+'</option>');
                }
            }

        });

    }
    //esta es la mimsa de que otra pero esta es para la de editar
    function buscar_cp_2(cp){

        $.ajax({
          url: "{{url('/get_cp')}}"+'/'+cp,
          dataType: "json",
          //context: document.body
        }).done(function(cp_data) {
            document.getElementById("estado_edit").value=null;
            $("#colonia_edit").empty();
            if(cp_data==null){
                document.getElementById("estado_edit").value=null;
                $("#colonia_edit").empty();
            }else{
                document.getElementById("estado_edit").value=cp_data[0].estado;
                for(var i=0;i<cp_data.length;i++){
                    $("#colonia_edit").append('<option value="'+cp_data[i].colonia+'">'+cp_data[i].colonia+'</option>');
                }
            }

        });

    }

    function pasar_datos_vehiculo(id_vehiculo_select,indice){

        $.ajax({
          url: "{{url('/get_vehiculo')}}"+'/'+id_vehiculo_select,
          dataType: "json",
          //context: document.body
        }).done(function(vehiculo_data) {

            if(vehiculo_data==null){
                document.getElementById("nombre_vehiculo"+indice).value=null;
                document.getElementById("funcion"+indice).value=null;
                document.getElementById("matricula"+indice).value=null;
            }else{
                document.getElementById("nombre_vehiculo"+indice).value=vehiculo_data.nombre;
                document.getElementById("funcion"+indice).value=vehiculo_data.funcion;
                document.getElementById("matricula"+indice).value=vehiculo_data.matricula;
            }

        });

    }

    function pasar_datos_vehiculo_2(id_vehiculo_select,indice){

        $.ajax({
          url: "{{url('/get_vehiculo')}}"+'/'+id_vehiculo_select,
          dataType: "json",
          //context: document.body
        }).done(function(vehiculo_data) {

            if(vehiculo_data==null){
                document.getElementById("nombre_vehiculo_edit"+indice).value=null;
                document.getElementById("funcion_edit"+indice).value=null;
                document.getElementById("matricula_edit"+indice).value=null;
            }else{
                document.getElementById("nombre_vehiculo_edit"+indice).value=vehiculo_data.nombre;
                document.getElementById("funcion_edit"+indice).value=vehiculo_data.funcion;
                document.getElementById("matricula_edit"+indice).value=vehiculo_data.matricula;
            }

        });

    }

    function diferecia_dias(indice){
        var fecha_1= new Date(document.getElementById("fecha_inicio"+indice).value).getTime();
        var fecha_2= new Date(document.getElementById("fecha_termino"+indice).value).getTime();
        //alert(fecha_1);
        //alert((fecha_2-fecha_1)/(1000*60*60*24));   //la multiplicacion te da los milisegundos que tiene un dia, y el metodo getTime() te da el valor en milisegundos.
        var result=((fecha_2-fecha_1)/(1000*60*60*24))*24;
        if (result>=1){
            document.getElementById("horas_trabajo"+indice).value=((fecha_2-fecha_1)/(1000*60*60*24))*24;
        }else{
            document.getElementById("horas_trabajo"+indice).value=null;
            document.getElementById("horas_trabajo"+indice).placeholder="operacion fallida";
        }
    }

    function diferecia_dias_2(indice){
        var fecha_1= new Date(document.getElementById("fecha_inicio_edit"+indice).value).getTime();
        var fecha_2= new Date(document.getElementById("fecha_termino_edit"+indice).value).getTime();
        //alert(fecha_1);
        //alert((fecha_2-fecha_1)/(1000*60*60*24));   //la multiplicacion te da los milisegundos que tiene un dia, y el metodo getTime() te da el valor en milisegundos.
        var result=((fecha_2-fecha_1)/(1000*60*60*24))*24;
        if (result>=1){
            document.getElementById("horas_trabajo_edit"+indice).value=((fecha_2-fecha_1)/(1000*60*60*24))*24;
        }else{
            document.getElementById("horas_trabajo_edit"+indice).value=null;
            document.getElementById("horas_trabajo_edit"+indice).placeholder="operacion fallida";
        }
    }

    function mantenimiento_horas(indice){    

        var dato= document.getElementById("mat_horas"+indice).value;
        var dato_2=0;
        if (document.getElementById("horas_trabajo"+indice).value>=1 && dato>=1){
            dato_2= document.getElementById("horas_trabajo"+indice).value;
            document.getElementById("no_mantenimientos"+indice).value=Math.round(dato_2/dato);
        }else{
            document.getElementById("no_mantenimientos"+indice).value=null;
            document.getElementById("no_mantenimientos"+indice).placeholder="operacion fallida";
        }
        activar_envio();
    }

    function mantenimiento_horas_2(indice){    

        var dato= document.getElementById("mat_horas_edit"+indice).value;
        var dato_2=0;
        if (document.getElementById("horas_trabajo_edit"+indice).value>=1 && dato>=1){
            dato_2= document.getElementById("horas_trabajo_edit"+indice).value;
            document.getElementById("no_mantenimientos_edit"+indice).value=Math.round(dato_2/dato);
        }else{
            document.getElementById("no_mantenimientos_edit"+indice).value=null;
            document.getElementById("no_mantenimientos_edit"+indice).placeholder="operacion fallida";
        }
        activar_envio_2();
    }


    var j=1;
    var contador=0;
    function agregar_prueba(){

            if(j>0){

                $("#contenedor_padre").append(

                    '<div id="contenedor_hijo'+j+'">'+
                        
                        '<div class="row">'+
                            '<div class="col-md-12" style="margin-bottom: 10px;">'+
                                '<label style="color: #888888;">Datos del Vehiculo</label>'+
                            '</div>'+
                        '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Matricula del Vehiculo</label>'+
                                '<select name="id_vehiculo'+j+'" class="form-control" id="id_vehiculo'+j+'" onchange="activar_envio(); pasar_datos_vehiculo(this.value,'+j+');" required>'+
                                    '<option value="" disabled selected>.:Selecciona:.</option>'+
                                    '@foreach($vehiculos as $vehiculo)'+
                                    '<option value="{{$vehiculo->id}}">{{$vehiculo->matricula}}</option>'+
                                    '@endforeach'+
                                '</select>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Nombre</label>'+
                                '<input type="text" name="nombre_vehiculo'+j+'" id="nombre_vehiculo'+j+'" class="form-control" onkeyup="activar_envio();" required readonly>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Funcion</label>'+
                                '<input type="text" name="funcion'+j+'" id="funcion'+j+'" class="form-control" onkeyup="activar_envio();" required readonly>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label></label><br>'+
                                '<button type="button" class="btn btn-danger eliminar_hijo" style="margin-top: 8px; width: 100%;" id="'+j+'"> eliminar </button>'+
                            '</div>'+
                        '</div>'+

                        '<div class="row">'+
                            '<div class="col-md-12" style="margin-bottom: 10px;">'+
                                '<label style="color: #888888;">Datos del Servicio</label>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Matricula del Vehiculo</label>'+
                                '<input type="text" name="matricula'+j+'" id="matricula'+j+'" class="form-control" onkeyup="activar_envio();" required readonly>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Fecha de inicio</label>'+
                                '<input type="date" name="fecha_inicio'+j+'" id="fecha_inicio'+j+'" class="form-control" onchange="activar_envio(); diferecia_dias('+j+');" required>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Fecha de Termino</label>'+
                                '<input type="date" name="fecha_termino'+j+'" id="fecha_termino'+j+'" class="form-control" onchange="activar_envio(); diferecia_dias('+j+');" required>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Horas de Trabajo</label>'+
                                '<input type="text" name="horas_trabajo'+j+'" id="horas_trabajo'+j+'" class="form-control" onkeyup="activar_envio();" required readonly>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Mant. después de (Hrs)</label>'+
                                '<input type="number" name="mat_horas'+j+'" id="mat_horas'+j+'" class="form-control" onkeyup="activar_envio(); mantenimiento_horas('+j+');" onchange="activar_envio(); mantenimiento_horas('+j+');" required min="1">'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>No. Mantenimientos</label>'+
                                '<input type="text" name="no_mantenimientos'+j+'" id="no_mantenimientos'+j+'" class="form-control" onchange="activar_envio();" required readonly>'+ 
                            '</div>'+
                            '<div class="col-md-6" style="margin-bottom: 10px;">'+
                                '<label>Observacines</label>'+
                                '<textarea name="observaciones'+j+'" id="observaciones'+j+'" class="form-control" rows="1" onkeyup="activar_envio();" ></textarea>'+
                            '</div>'+
                        '</div>'+

                    '</div>'


                );
                j++;
                contador++;

            }
            //console.log(contador);
            document.getElementById("cantidad_vehiculos").value=contador;
            activar_envio();
    }

    var j_2=1;
    var contador_2=0;
    function agregar_prueba_2(){

            if(j_2>0){

                $("#contenedor_padre_edit").append(

                    '<div id="contenedor_hijo_edit'+j_2+'">'+
                        
                        '<div class="row">'+
                            '<div class="col-md-12" style="margin-bottom: 10px;">'+
                                '<label style="color: #888888;">Datos del Vehiculo</label>'+
                            '</div>'+
                        '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Matricula del Vehiculo</label>'+
                                '<select name="id_vehiculo'+j_2+'" class="form-control" id="id_vehiculo_edit'+j_2+'" onchange="activar_envio_2(); pasar_datos_vehiculo_2(this.value,'+j_2+');" required>'+
                                    '<option value="" disabled selected>.:Selecciona:.</option>'+
                                    '@foreach($vehiculos as $vehiculo)'+
                                    '<option value="{{$vehiculo->id}}">{{$vehiculo->matricula}}</option>'+
                                    '@endforeach'+
                                '</select>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Nombre</label>'+
                                '<input type="text" name="nombre_vehiculo'+j_2+'" id="nombre_vehiculo_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2();" required readonly>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Funcion</label>'+
                                '<input type="text" name="funcion'+j_2+'" id="funcion_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2();" required readonly>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label></label><br>'+
                                '<button type="button" class="btn btn-danger eliminar_hijo_edit" style="margin-top: 8px; width: 100%;" id="'+j_2+'"> eliminar </button>'+
                            '</div>'+
                        '</div>'+

                        '<div class="row">'+
                            '<div class="col-md-12" style="margin-bottom: 10px;">'+
                                '<label style="color: #888888;">Datos del Servicio</label>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Matricula del Vehiculo</label>'+
                                '<input type="text" name="matricula'+j_2+'" id="matricula_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2();" required readonly>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Fecha de inicio</label>'+
                                '<input type="date" name="fecha_inicio'+j_2+'" id="fecha_inicio_edit'+j_2+'" class="form-control" onchange="activar_envio_2(); diferecia_dias_2('+j_2+');" required>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Fecha de Termino</label>'+
                                '<input type="date" name="fecha_termino'+j_2+'" id="fecha_termino_edit'+j_2+'" class="form-control" onchange="activar_envio_2(); diferecia_dias_2('+j_2+');" required>'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Horas de Trabajo</label>'+
                                '<input type="text" name="horas_trabajo'+j_2+'" id="horas_trabajo_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2();" required readonly>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>Mant. después de (Hrs)</label>'+
                                '<input type="number" name="mat_horas'+j_2+'" id="mat_horas_edit'+j_2+'" class="form-control" onkeyup="activar_envio_2(); mantenimiento_horas_2('+j_2+');" onchange="activar_envio_2(); mantenimiento_horas_2('+j_2+');" required min="1">'+
                            '</div>'+
                            '<div class="col-md-3" style="margin-bottom: 10px;">'+
                                '<label>No. Mantenimientos</label>'+
                                '<input type="text" name="no_mantenimientos'+j_2+'" id="no_mantenimientos_edit'+j_2+'" class="form-control" onchange="activar_envio_2();" required readonly>'+ 
                            '</div>'+
                            '<div class="col-md-6" style="margin-bottom: 10px;">'+
                                '<label>Observacines</label>'+
                                '<textarea name="observaciones'+j_2+'" id="observaciones_edit'+j_2+'" class="form-control" rows="1" onkeyup="activar_envio_2();" ></textarea>'+
                            '</div>'+
                        '</div>'+

                    '</div>'


                );
                j_2++;
                contador_2++;

            }
            //console.log(contador);
            document.getElementById("cantidad_vehiculos_edit").value=contador_2;
            activar_envio_2();
    }

    $(document).on('click', '.eliminar_hijo', function(){
        var id=$(this).attr("id"); 
        $('#contenedor_hijo'+id+'').remove();
        contador--;
        //j--;
        document.getElementById("cantidad_vehiculos").value=contador;
        activar_envio();
    });

    $(document).on('click', '.eliminar_hijo_edit', function(){
        var id=$(this).attr("id"); 
        $('#contenedor_hijo_edit'+id+'').remove();
        contador--;
        //j--;
        document.getElementById("cantidad_vehiculos_edit").value=contador;
        activar_envio_2();
    });

    //este es para saber que dispositivo se esta usando y mandarlo a otro lado al usuario ya que no se mira bien el pdf
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        document.getElementById("no_se_mira").style.display="block";
    }else{
        console.log("No estás usando un móvil");
    }
    
</script>

@stop