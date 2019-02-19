@extends('template.main')

@section('title','Reset Password')

@section('contend')
 <div class="container-scroller">
     <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
			<div class="auto-form-wrapper">

              @if (session('status'))
	                <div class="alert alert-success" role="alert">
	                    {{ session('status') }}
	                </div>
              @endif

              <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                <div class="form-group">
                  <label class="label">Email</label>
                  <div class="input-group">
                    
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus=""  required>

                    @if ($errors->has('email'))
                           <span class="invalid-feedback" role="alert">
                             	<strong>{{ $errors->first('email') }}</strong>
                            </span>
                     @endif          

                    <div class="input-group-append">
                      <span class="input-group-text" id="em">
                        
                      </span>
                    </div>

                  </div>
                </div>

                <div class="form-group">
                
                   <button disabled="" id="entrar" type="submit" class="btn btn-primary btn-block">{{ __(' Enviar link') }}
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
    
    $(document).ready(function(){

        EliminarIcon("#email", "#em");
       
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
          
           if (correo == true) {
              AgregarIconSuccess(em);
           }else{
              AgregarIconDanger(em);
           }

           VerificarCampos(correo);
        });

       function VerificarCampos(correo){
          if (correo == true) {
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