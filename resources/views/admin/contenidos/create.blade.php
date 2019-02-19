<div class="modal fade" id="create_contend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Crear Contenido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('contenidos.store')}}" method="POST" id="form_contend_create">
        {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="" class="form-label">Nombre</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-rounded" id="enviar_contend" >Enviar</button>
      </div>
        
      </form>
    </div>
  </div>
</div>







