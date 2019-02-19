@extends('template.main')

@section('title','Register')

@section('contend')
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
            <div class="auto-form-wrapper">

              <form id="form" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf

                <div class="form-group">
                  <div class="input-group">
                    
                    <input placeholder="Nombre" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>

                    <div class="input-group-append">
                      <span class="input-group-text" id="nam">
                        
                      </span>
                    </div>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

                    
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    
                    <input placeholder="Correo" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                    <div class="input-group-append">
                      <span class="input-group-text" id="em">
                        
                      </span>
                    </div>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    
                    <input placeholder="Contraseña" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                    
                    <div class="input-group-append">
                      <span class="input-group-text" id="pass" >
                        
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
                  <div class="input-group">
                    
                    <input placeholder="Confirmar Contraseña" id="password_confirm" type="password" class="form-control" name="password_confirmation">
                    
                    <div class="input-group-append">
                      <span class="input-group-text" id="pass2">
                        
                      </span>
                    </div>

                  </div>
                </div>

                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input id="checkbox" type="checkbox" class="form-check-input"> Acepto los términos y condiciones
                    </label>
                  </div>
                </div>
                <div class="form-group">

                  <button id="registrar" type="submit" class="btn btn-primary btn-block" disabled="" >{{ __('Registrar') }}</button>

                </div>

                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Tienes una cuenta ?</span>
                  <a href="{{ route('login') }}" class="text-black text-small">Incia sesión</a>
                </div>

              </form>
            </div>
          </div>
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
    $(function(){

      EliminarIcon("#name", "#nam");
      EliminarIcon("#email", "#em");
      EliminarIcon("#password", "#pass");
      EliminarIcon("#password_confirm", "#pass2");

      if ($("#form :input").hasClass("is-invalid")) {
          $("#form")[0].reset();    
      }

      $("#form :input").blur(function(){
        $("#form :input").removeClass("is-invalid");
        $(".invalid-feedback").removeClass("invalid-feedback").html("");
      });

      $("#name").blur(function(){
        var nombre = $("#name").val();
        var nam  = $("#nam");

        var email = $("#email").val();
        var correo = validar_email(email);
        var password = $("#password").val();
        var password_confirm = $("#password_confirm").val();

        if (nombre == "") {
            AgregarIconDanger(nam);
        }else{
            AgregarIconSuccess(nam);
        }

        VerificarCampos(nombre, correo, password, password_confirm);
      });

      $("#email").blur(function(){
          var email = $("#email").val();
          var em    = $("#em")
          var correo = validar_email(email);

          var nombre = $("#name").val();
          var password = $("#password").val();
          var password_confirm = $("#password_confirm").val();

           if (correo == true) {
              AgregarIconSuccess(em);
           }else{
              AgregarIconDanger(em);
           }

          VerificarCampos(nombre, correo, password, password_confirm);
      });

        $("#password").blur(function(){
         var password = $("#password").val();
         var pass     = $("#pass");

         var nombre = $("#name").val();
         var email = $("#email").val();
         var correo = validar_email(email);
         var password_confirm = $("#password_confirm").val();

           if (password == "" ) {
                AgregarIconDanger(pass);
            }else if(password.length >= 6 ) {
                AgregarIconSuccess(pass);
            }else{
                AgregarIconDanger(pass);
            }

            VerificarCampos(nombre, correo, password, password_confirm);
        });

        $("#password_confirm").blur(function(){
          var password_confirm = $("#password_confirm").val();
          var pass2     = $("#pass2");
          var password = $("#password").val();

          var nombre = $("#name").val();
          var email = $("#email").val();
          var correo = validar_email(email);
          var password = $("#password").val();

          if (password_confirm == "" ) {
              AgregarIconDanger(pass2);
          }else if(password_confirm.length >= 6 && password_confirm == password  ) {
              AgregarIconSuccess(pass2);
          }else{
              AgregarIconDanger(pass2);
          }

          VerificarCampos(nombre, correo, password, password_confirm);
        });


        $("#checkbox").click(function(){

          var nombre = $("#name").val();
          var email = $("#email").val();
          var correo = validar_email(email);
          var password = $("#password").val();
          var password_confirm = $("#password_confirm").val()

          VerificarCampos(nombre, correo, password, password_confirm);
        });

          function VerificarCampos(nombre,correo, password, password_confirm){

            var checkbox = $("#checkbox").is(":checked") ? true : false;

            if (nombre !="" && correo == true && password.length >=6 && password_confirm.length >=6 && password_confirm == password && checkbox == true) {
              EliminarDisable();
            }else{
              AgregarDisable();
            }
          }

          function EliminarDisable(){
              $("#registrar").attr("disabled",false);     
          }

          function AgregarDisable(){
              $("#registrar").attr("disabled", true);
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