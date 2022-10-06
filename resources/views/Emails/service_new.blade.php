<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Servicios</title>
</head>
<body style="background-color: #E8E7E2; padding-top: 10px; padding-bottom: 10px;">

	<div style="margin-right: 25%; margin-left: 25%; margin-top: 20px; margin-bottom:20px; border-radius: 10px; background-color: white;">

		
		<img src="{{url('imagenes/correo.png')}}" style="width: 100%; height: auto; border-radius: 15px;">

		<div  style="margin-bottom: 20px; text-align: center;">
			<label style="font-weight: 35px;  width: 100%; font-family: 'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, 'AppleGothic', sans-serif;font-size: 50px;">
				@if($datos['tipo'] == "nuevo")
				Se creo un nuevo servicio
				@endif
				@if($datos['tipo'] == "actualizar")
				Se actualizo el servicio
				@endif
				@if($datos['tipo'] == "eliminar")
				Se elimino el servicio
				@endif
		</label>
		</div>
		<br><br>
		<div style="margin-bottom: 20px; text-align: center; font-weight: 35px;  width: 100%; font-family: 'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, 'AppleGothic', sans-serif;font-size: 20px;">
			<label>Hecho por: {{$datos['usuario']}}</label><br>
			<label>Cliente: {{$datos['empresa']}}</label><br>
			<label>Direccion: {{$datos['direccion']}}</label><br>
			@if($datos['tipo'] != "eliminar")
			<label>Cantidad de Vehiculos: {{$datos['cantidad']}}</label>
			@endif
		</div>
		<br>
		<br>
		<div style="margin-bottom: 20px; text-align: center;">
			<a href="{{url('/Servicios')}}" style="border-radius: 10px; text-decoration: none; font-size: 35px; background-color: #C6B830; color: black; width: 100%; padding: 15px;">
				VER REGISTROS
				<img src="{{url('imagenes/envio3.png')}}" style="width: 30px; height: auto;">
			</a>
		</div>
		<br><br>
		<div style="margin-bottom: 20px; text-align: center;">
			@if($datos['tipo'] != "eliminar")
			<a style="border-radius: 100px; text-decoration: none;color: black; width: 100%; padding-top: 38px; padding-left: 10px; padding-right: 10px; border: solid; " href="{{url('/PDF_servicio')}}/{{$datos['id_servicio']}}" download="informe"><img src="{{url('imagenes/pdf1.png')}}" style="width: 50px; height: auto;"></a>
			@endif
		</div>
		<br><br>
		
		
	</div>

	



</body>
</html>