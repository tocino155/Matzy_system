<x-guest-layout >
    <x-jet-authentication-card >
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

    <div class="container-fluid fixed-top " style="background-color: #000000; height: 12%; padding-right: 0px; padding-left: 0px;">
        
            <img src="/imagenes/logonuevoB.png" style="width: auto; height: 90%; margin-left: 15px;">
        
        <div class="col-12">
            <div style="position: absolute; text-align: right; margin-top: -50px; padding-right: 15px; width: 100%;">
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a href="{{ url('/Home') }}" class="btn" style="color: black; background-color: #F5B32B;">Inicio</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div style="width: 100%; background-color: #F5B32B; height: 15px; bottom: 0px;"></div>
    </div>

        <div class="card-body" >

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3" style="color: black;">
                    <x-jet-label value="{{ __('CORREO') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required placeholder="CORREO" id="correo" onchange="activar_button();"/>
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3" style="color: black;">
                    <x-jet-label value="{{ __('CONTRASEÑA') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" placeholder="CONTRASEÑA" id="contrasena" onkeydown="activar_button();"/>
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>


                <div class="" style="text-align: center;">

                    <button class="btn" id="butt" style="width: 100%;">
                        ENTRAR
                    </button>

                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>

<script type="text/javascript">
    
    function activar_button(){
        if (document.getElementById("correo").value!="" && document.getElementById("contrasena").value!=""){
            document.getElementById("butt").style.backgroundColor= "#F5B32B";
            document.getElementById("butt").disabled = false; 
        }else{
            document.getElementById("butt").style.backgroundColor= "rgba(0, 0, 0, 0)";
            document.getElementById("butt").disabled = true;
        }
    }
</script>