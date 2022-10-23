@extends('adminlte::page')

@section('title', 'Home')

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
    
    div::-webkit-scrollbar {
      width: 12px;               /* width of the entire scrollbar */
    }

    div::-webkit-scrollbar-track {
      background: transparent;        /* color of the tracking area */
    }

    div::-webkit-scrollbar-thumb {
      background-color: #111111;    /* color of the scroll thumb */
      border-radius: 20px;       /* roundness of the scroll thumb */
      border: 2px solid white;  /* creates padding around scroll thumb */
    }

</style>

<div>
    <h3>Home</h3>
</div>

<div class="card">
    <div class="card-body">

        <div class="row">

            <!-- vehiculos disponibles -->
            <div class="col-md-6">

                <div class="card bg-gradient-gray">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                          <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                        Vehiculos Disponibles
                        </h3>

                        <div class="card-tools">
                            
                            <button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 250px; width: 100%; overflow-y: auto;">

                            @forelse ($vehiculos as $vehiculo)
                            <div class=" card bg-gradient-gray disabled border-0" style="text-align: center; margin: 8px; margin-bottom: 20px;">
                                <div class="row">

                                    <div class="col-md-6" >
                                        <label>Nombre:</label><br>
                                        <label>{{$vehiculo->nombre}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nombre: </label><br>
                                        <label>{{$vehiculo->matricula}}</label>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            @empty
                                <div class="col-md-12" style="font-size: 35px; text-align: center;">NO EXISTEN REGISTROS</div>
                            @endforelse   

                                    
                        </div>
                    </div>
                    <!-- este es para cosas hasta habajo
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visitors</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Online</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

            </div>
            <!-- vehiculos con fecha terminada -->
            <div class="col-md-6">

                <div class="card bg-gradient-gray">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-truck-flatbed" viewBox="0 0 16 16">
                          <path d="M11.5 4a.5.5 0 0 1 .5.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-4 0 1 1 0 0 1-1-1v-1h11V4.5a.5.5 0 0 1 .5-.5zM3 11a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm1.732 0h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4a2 2 0 0 1 1.732 1z"/>
                        </svg>
                        Vehiculos con servicio activo pero fecha terminada
                        </h3>

                        <div class="card-tools">
                            
                            <button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 250px; width: 100%;  overflow-y: auto;">

                            @if($vehiculos_servicio_activo != null)

                                @forelse ($vehiculos_servicio_activo as $vehiculo_servicio_activo)
                                <div class=" card bg-gradient-gray disabled border-0" style="text-align: center; margin: 8px; margin-bottom: 20px;">
                                    <div class="row">

                                        <div class="col-md-6" >
                                            <label>Nombre:</label><br>
                                            <label>{{$vehiculo_servicio_activo->nombre}}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nombre: </label><br>
                                            <label>{{$vehiculo_servicio_activo->matricula}}</label>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                @empty
                                    <div class="col-md-12" style="font-size: 35px; text-align: center;">NO EXISTEN REGISTROS</div>
                                @endforelse
                            @else
                                <div class="col-md-12" style="font-size: 35px; text-align: center;">NO EXISTEN REGISTROS</div>
                            @endif
                            
                        </div>
                    </div>
                    <!-- este es para cosas hasta habajo
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visitors</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Online</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

            </div>

            <!--servicios ultimo -->
            <div class="col-md-6">

                <div class="card bg-gradient-info">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                        <i class="nav-icon fas fa-fw fa-cog "></i>
                        Ultimo servicio
                        </h3>

                        <div class="card-tools">
                            
                            <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 150px; width: 100%;  overflow-y: auto;">

                            @if($ultimo_id != null)
                            <div class=" card bg-gradient-info disabled border-0" style="text-align: center; margin: 8px; margin-bottom: 20px;">
                                <div class="row">

                                    <div class="col-md-3" >
                                        <label>Cliente:</label><br>
                                        <label>{{$ultimo_id->nombre}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Direccion: </label><br>
                                        <label>{{$ultimo_id->domicilio}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Observaciones: </label><br>
                                        <label>{{$ultimo_id->observaciones}}</label>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            @else
                                <div class="col-md-12" style="font-size: 35px; text-align: center;">NO EXISTEN REGISTROS</div>
                            @endif
                            
                        </div>
                    </div>
                    <!-- este es para cosas hasta habajo
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visitors</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Online</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

            </div>

            <!--servicios con finanza -->
            <div class="col-md-6">

                <div class="card bg-gradient-olive">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                        <i class="nav-icon fas fa-fw fa-cog "></i>
                        <i class="nav-icon fas fa-fw fa-credit-card "></i>
                        Servicios con finanza activa
                        </h3>

                        <div class="card-tools">
                            
                            <button type="button" class="btn bg-gradient-olive btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 150px; width: 100%;  overflow-y: auto;">

                            @forelse ($servicios_con_ingreso as $servicio_con_ingreso)
                            <div class=" card bg-gradient-olive border-0" style="text-align: center; margin: 8px; margin-bottom: 20px;">
                                <div class="row">

                                    <div class="col-md-3" >
                                        <label>Cliente:</label><br>
                                        <label>{{$servicio_con_ingreso->nombre}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Direccion: </label><br>
                                        <label>{{$servicio_con_ingreso->domicilio}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Observaciones: </label><br>
                                        <label>{{$servicio_con_ingreso->observaciones}}</label>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            @empty
                                <div class="col-md-12" style="font-size: 35px; text-align: center;">NO EXISTEN REGISTROS</div>
                            @endforelse
                            
                        </div>
                    </div>
                    <!-- este es para cosas hasta habajo
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visitors</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Online</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

            </div>

            <!--ultimo ingreso -->
            <div class="col-md-6">

                <div class="card bg-gradient-orange">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-piggy-bank-fill" viewBox="0 0 16 16">
                          <path d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069c0-.145-.007-.29-.02-.431.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a.95.95 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.735.735 0 0 0-.375.562c-.024.243.082.48.32.654a2.112 2.112 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595Zm7.173 3.876a.565.565 0 0 1-.098.21.704.704 0 0 1-.044-.025c-.146-.09-.157-.175-.152-.223a.236.236 0 0 1 .117-.173c.049-.027.08-.021.113.012a.202.202 0 0 1 .064.199Zm-8.999-.65a.5.5 0 1 1-.276-.96A7.613 7.613 0 0 1 7.964 3.5c.763 0 1.497.11 2.18.315a.5.5 0 1 1-.287.958A6.602 6.602 0 0 0 7.964 4.5c-.64 0-1.255.09-1.826.254ZM5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                        </svg>
                        Ultimo ingreso en finanzas
                        </h3>

                        <div class="card-tools">
                            
                            <button type="button" class="btn bg-gradient-orange btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 150px; width: 100%;  overflow-y: auto;">

                            @if($ultimo_ingreso != null)
                            <div class=" card bg-gradient-orange disabled border-0" style="text-align: center; margin: 8px; margin-bottom: 20px;">
                                <div class="row">

                                    <div class="col-md-3" >
                                        <label>Concepto:</label><br>
                                        <label>{{$ultimo_ingreso->concepto}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Cantidad: </label><br>
                                        <label>{{$ultimo_ingreso->cantidad}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Observaciones: </label><br>
                                        <label>{{$ultimo_ingreso->observaciones}}</label>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            @else
                                <div class="col-md-12" style="font-size: 35px; text-align: center;">NO EXISTEN REGISTROS</div>
                            @endif
                            
                        </div>
                    </div>
                    <!-- este es para cosas hasta habajo
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visitors</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Online</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

            </div>

            <!--ultimo egreso -->
            <div class="col-md-6">

                <div class="card " style="background-color: #FF7171;">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                        </svg>
                        Ultimo egreso en finanzas
                        </h3>

                        <div class="card-tools">
                            
                            <button type="button" class="btn btn-danger btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 150px; width: 100%;  overflow-y: auto;">

                            @if($ultimo_egreso != null)
                            <div class=" card  disabled border-0" style="text-align: center; margin: 8px; margin-bottom: 20px; background-color: #FF9A9A;">
                                <div class="row">

                                    <div class="col-md-3" >
                                        <label>Concepto:</label><br>
                                        <label>{{$ultimo_egreso->concepto}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Cantidad: </label><br>
                                        <label>{{$ultimo_egreso->cantidad}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Observaciones: </label><br>
                                        <label>{{$ultimo_egreso->observaciones}}</label>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            @else
                                <div class="col-md-12" style="font-size: 35px; text-align: center;">NO EXISTEN REGISTROS</div>
                            @endif
                            
                        </div>
                    </div>
                    <!-- este es para cosas hasta habajo
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visitors</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Online</div>
                            </div>

                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

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

</script>

@stop
