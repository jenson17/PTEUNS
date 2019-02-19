<div class="modal fade" id="show_comentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Editar Comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_comentario_show">
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <textarea class="form-control" name="comentario" rows="5" id="comentario"></textarea>
            </div>
          </div>
        </div>
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-rounded" id="editar_comentario" >Editar</button>
      </div>  
      </form>
    </div>
  </div>
</div>

