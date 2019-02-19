<div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Editar Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_user_edit">
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Nombre</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Nombre">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Email</label>
              <input type="text" name="email" id="email" class="form-control" placeholder="Nombre">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success btn-rounded" id="enviar" >Editar</button>
      </div>
        
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="password_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Cambiar Clave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="GET" action="{{ url('cambiarPassword') }}" id="form-cambiar-password">
            <div class="modal-body">
                <input type="hidden" name="_token" value="Z2cAFI44oKGzmoANbM83sM7YKzfiQ9SNsbQ7psSs">
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    <label for="label">Antigua Contraseña</label>
                    <input class="form-control" id="old_password" type="password" name="old_password">
                </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    <label for="label">Nueva Contraseña</label>
                    <input class="form-control" id="new_password_1" type="password" name="new_password_1">
                </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                    <label for="label">Repita Nueva Contraseña</label>
                    <input class="form-control" id="new_password_2" type="password" name="new_password_2">
                </div>
                <div class="clearfix"></div>
            </div>

        <div class="modal-footer">
          <button class="btn btn-default" type="reset">Limpiar</button>
          <button class="btn btn-primary btn-rounded" type="submit">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('js')
@include('users.js.index')
@endpush