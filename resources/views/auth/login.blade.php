@extends('template.main')

@section('title','Login')

@section('contend')
	<div class="container-scroller">
     <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
			      <div class="auto-form-wrapper">
              <form  id="form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
               @csrf

                <div class="form-group">
                  <label class="label">Correo</label>
                  <div class="input-group">
                 
                    <input placeholder="ejemplo@gmail.com" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>

                     <div class="input-group-append">
                      <span class="input-group-text" id="em"></span>
                    </div>
                  

                    @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif 

                    
                  </div>
                  
                </div>
                <div class="form-group">
                  <label class="label">Contraseña</label>
                  <div class="input-group">
                     <input placeholder="**********" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                      
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i id="pw"></i>
                        </span>
                      </div>
                      
                      @if ($errors->has('password'))
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                            </span>
                      @endif

                  </div>
                </div>

                <div class="form-group">
                  <!--<button class="btn btn-primary submit-btn btn-block">Login</button>-->

                   <button id="entrar" type="submit" class="btn btn-primary btn-block" disabled="">{{ __('Entrar') }}</button>

                </div>


                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    
                    <label class="form-check-label" for="remember">{{ __('Recuerdame') }}
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    </label>

                  </div>
                 
                  <a class="text-small forgot-password text-black" href="{{ route('password.request') }}">
                                    {{ __('Olvido su contraseña?') }}
                  </a>

                </div>
               
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">No eres miembro ?</span>
                  <a href="{{ route('register') }}" class="text-black text-small">Crea una cuenta</a>
                </div>

              </form>

            </div>
            <ul class="auth-footer">
              <li>
                <a href="#">Condiciones</a>
              </li>
              <li>
                <a href="#">Ayuda</a>
              </li>
              <li>
                <a href="#">Términos</a>
              </li>
            </ul>
            <p class="footer-text text-center">Copyright © 2019</p>
          </div>
        </div>
      </div>
       <!-- content-wrapper ends -->
    </div>
      <!-- page-body-wrapper ends -->
  </div>
@endsection

@push('js')
<script>
    
    $(document).ready(function(){

        EliminarIcon("#email", "#em");
        EliminarIcon("#password", "#pw");

        if ($("#form :input").hasClass("is-invalid")) {
            $("#form")[0].reset();    
        }

        $("#form :input").blur(function(){
          	$("#form :input").removeClass("is-invalid");
          	$(".invalid-feedback").removeClass("invalid-feedback").html("");
        });

        $("#email").blur(function(){
          
           var email = $("#email").val();
           var em    = $("#em")
           var correo = validar_email(email);
           var password = $("#password").val();

           if (correo == true) {
              AgregarIconSuccess(em);
           }else{
              AgregarIconDanger(em);
           }

           VerificarCampos(correo,password);
        });

        $("#password").blur(function(){
          
          var email = $("#email").val();
          var correo = validar_email(email);
          var password = $("#password").val();
          var pw = $("#pw");

          if (password == "" ) {
              AgregarIconDanger(pw);
          }else if(password.length >= 6 ) {
              AgregarIconSuccess(pw);
          }else{
             AgregarIconDanger(pw);
          }

          VerificarCampos(correo,password);
        });

       function VerificarCampos(correo, password){
       	  if (correo == true && password.length >=6 ) {
        	 EliminarDisable();
          }else{
        	 AgregarDisable();
          }
       }

       function EliminarDisable(){
          $("#entrar").attr("disabled",false);  	 
       }

       function AgregarDisable(){
       	  $("#entrar").attr("disabled", true);
       }

        function validar_email( email ){
            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email) ? true : false;
        }

        function EliminarIcon(id, sig){ 
          $(id).focus(function(){
            $(sig).removeClass("mdi mdi-check-circle-outline text-success");
            $(sig).removeClass("mdi mdi-bookmark-remove text-danger");
          });
        }

        function AgregarIconSuccess(sig){
          $(sig).addClass("mdi mdi-check-circle-outline text-success");
        }

        function AgregarIconDanger(sig){
          $(sig).addClass("mdi mdi-bookmark-remove text-danger");
        }
    });
</script>
@endpush