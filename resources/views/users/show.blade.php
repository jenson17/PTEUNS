<div class="modal fade" id="show_mensaje_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Ver Mensaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_show_mensaje">
        {{ csrf_field() }}
      <div class="modal-body">
        <input type="hidden" name="mensaje_id" id="mensaje_id">
        <div class="row">
          <div class="col-md-2">
            <div class="preview-thumbnail">
              <img class="img-sm rounded-circle mb-4 mb-md-0" src="{{asset('plugins/images/faces/default.jpg')}}"  alt="profile image"> 
           </div>
          </div>
          <div class="col-md-10">
            <div class="form-group">
              <label class="form-label form-control" name="mensaje_show" id="mensaje_show"></label>
            </div>
          </div>

        </div>

        <div id="agregar">
          
        </div>

        <div class="row">
          <div class="col-md-2">
            <div class="preview-thumbnail">
              <img class="img-sm rounded-circle mb-4 mb-md-0" src="{{asset('plugins/images/faces/default.jpg')}}"  alt="profile image"> 
           </div>

          </div>
          <div class="col-md-10">
            <div class="form-group">
             <textarea class="form-control" name="respuesta" id="respuesta" row="3"></textarea>
            </div>
          </div>
        </div>
      </div>  
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary">Limpiar</button>
        <button type="submit" class="btn btn-primary btn-rounded" id="show_msj" >Enviar</button>
      </div>  
      </form>
    </div>
  </div>
</div>
