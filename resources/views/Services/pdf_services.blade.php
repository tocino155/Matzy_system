<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DATOS DEL SERVICIO</title>
    <link href="http://fonts.cdnfonts.com/css/agency-fb" rel="stylesheet">
</head>
<style type="text/css">

    @font-face {

        font-family: Agency FB;

        src: url(http://uncutbeatz.com/clear/fonts/AGENCYR.TTF.ttf);

        font-style:normal;

    }
    
    *{
        margin: 0;
        padding: 0;
            
        }

    body{   

        
        font-size: 12px;
        background-color: red;
        width: 1583px;
        height: 2048px;
        padding-top: 350px;
        padding-bottom: 75px;
        margin: 0;
        background-color: rgb(255, 255, 255);
        background-image: url(./plantillas/plantillapdf.png);
        background-repeat: no-repeat;
    }

    header{
        //background-color: darkblue;
        /*height: 1615px;*/
        
    }

    
</style>
<body>

<header>
    <p style=" margin-top: 55px;  padding-left: 1220px; position: absolute; font-size: 30px;">Folio: CMZ-{{$datos->id}}</p>
    <p style=" margin-top: 110px;  padding-left: 50px; position: absolute; font-size: 30px;">Datos del Cliente</p>

    <table class="table" style="border-collapse:separate; width: 100%; margin-top: 145px;   border-spacing:0 55px;">
        
        <tbody>
          <tr style="font-weight: 0; ">
            <td style="font-size: 30px; width: 50px;" ></td>
            <td style="font-size: 30px; width: 580px;" >Nombre / Empresa: {{$datos->nombre}}</td>
            <td style="font-size: 30px; " >C.P.: {{$datos->cp}}</td>
            <td style="font-size: 30px;" >Estado: {{$datos->estado}}</td>
            <td style="font-size: 30px; ">Colonia: {{$datos->colonia}}</td>
            <td style="font-size: 30px;" ></td>
          </tr>
          <tr style="font-weight: 0;">
            <td style="font-size: 30px; " ></td>
            <td style="font-size: 30px;" >Domicilio: {{$datos->domicilio}}</td>
            <td style="font-size: 30px; " >Telefono: {{$datos->telefono}}</td>
            <td style="font-size: 30px;" colspan="2">Correo: {{$datos->correo}}</td>
            <td style="font-size: 30px; width: 50px;" ></td>
          </tr>

        </tbody>
    </table>

    <table class="table" style="border-collapse:separate; width: 100%; margin-top: -60px; border-spacing:0 55px;">
        
        <tbody>
          <tr style="font-weight: 0;">
            <td style="font-size: 30px; " ></td>
            <td style="font-size: 30px; " colspan="4"><br>Datos del Vehiculo(s) </td>
            <td style="font-size: 30px; width: 50px;" ></td>
          </tr>
          @foreach($servicio_vehiculos as $servicio_vehiculo)
          <tr style="font-weight: 0; ">
            <td style="font-size: 30px; " ></td>
            <td style="font-size: 30px; " >Matricula: {{$servicio_vehiculo->matricula_vehiculo}}</td>
            <td style="font-size: 30px; " >Nombre: {{$servicio_vehiculo->nombre_vehiculo}}</td>
            <td style="font-size: 30px; " colspan="2" >Funcion: {{$servicio_vehiculo->funcion_vehiculo}}</td>
            <td style="font-size: 30px; width: 50px;" ></td>
          </tr>
          <tr style="font-weight: 0;">
            <td style="font-size: 30px; width: 50px;" ></td>
            <td style="font-size: 30px; width: 580" colspan="2">Fecha de inicio del Servicio del Vehiculo: {{$servicio_vehiculo->fecha_inicio}}</td>
            <td style="font-size: 30px; " colspan="2">Fecha de termino del Servicio del Vehiculo: {{$servicio_vehiculo->fecha_fin}}</td>
            <td style="font-size: 30px; width: 50px;" ></td>
          </tr>
          <tr style="font-weight: 0;">
            <td style="font-size: 30px; " ></td>
            <td style="font-size: 30px; " colspan="2">Horas de servicio para el Vehiculo: {{$servicio_vehiculo->mantenimiento_h}}hrs.</td>
            <td style="font-size: 30px; " colspan="2">No. Mantenimientos para el vehiculo en el periodo del servicio: {{$servicio_vehiculo->no_mantenimientos}}</td>
            <td style="font-size: 30px; width: 50px;" ></td>
          </tr>
          <tr style="font-weight: 0;">
            <td style="font-size: 30px; " ></td>
            <td style="font-size: 30px;" colspan="4">Observaciones:<br>{{$servicio_vehiculo->observaciones}}</td>
            <td style="font-size: 30px; width: 50px;" ></td>
          </tr>
          @endforeach
          <tr style="font-weight: 0;">
            <td style="font-size: 30px; " ></td>
            <td style="font-size: 30px;" colspan="4"><br>Observaciones generales del servicio: <br>{{$datos->observaciones}}</td>
            <td style="font-size: 30px; width: 50px;" ></td>
          </tr>
        </tbody>
    </table>

</header>


</body>

</html>



