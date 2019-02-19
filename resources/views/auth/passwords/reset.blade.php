@extends('template.main')

@section('title','Reset Password')

@section('contend')
 <div class="container-scroller">
     <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
			       <div class="auto-form-wrapper">

             <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                  <div class="input-group">
                    <label class="label">Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

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
                    <label class="label">Contraseña</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                    
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
                    <label class="label">Confirmar Contraseña</label>
                    <input id="password_confirm" type="password" class="form-control" name="password_confirmation">
                    
                    <div class="input-group-append">
                      <span class="input-group-text" id="pass2">
                        
                      </span>
                    </div>

                  </div>
                </div>

                <div class="form-group">
                
                   <button disabled="" id="reset" type="submit" class="btn btn-primary btn-block">{{ __(' Reset Password ') }}
                   </button>

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
            <p class="footer-text text-center">copyright © 2019.</p>
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

      $("#email").blur(function(){
          var email = $("#email").val();
          var em    = $("#em")
          var correo = validar_email(email);

          var password = $("#password").val();
          var password_confirm = $("#password_confirm").val();

           if (correo == true) {
              AgregarIconSuccess(em);
           }else{
              AgregarIconDanger(em);
           }

          VerificarCampos(correo, password, password_confirm);
      });

        $("#password").blur(function(){
         var password = $("#password").val();
         var pass     = $("#pass");

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

            VerificarCampos(correo, password, password_confirm);
        });

        $("#password_confirm").blur(function(){
          var password_confirm = $("#password_confirm").val();
          var pass2     = $("#pass2");
          var password = $("#password").val();

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

          VerificarCampos(correo, password, password_confirm);
        });


          function VerificarCampos(correo, password, password_confirm){

            if (correo == true && password.length >=6 && password_confirm.length >=6 && password_confirm == password) {
              EliminarDisable();
            }else{
              AgregarDisable();
            }
          }

          function EliminarDisable(){
              $("#reset").attr("disabled",false);     
          }

          function AgregarDisable(){
              $("#reset").attr("disabled", true);
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