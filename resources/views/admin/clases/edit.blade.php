<div class="modal fade" id="edit_clase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary">Editar Clase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_class_edit">
      {{ csrf_field() }}
      <div class="modal-body">
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Nombre</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
          </div>
        </di>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Contenidos</label>
              <select id="contend_id" name="contend_id" class="form-control"></select>
            </div>
          </div>
        </di>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group">
             <label for="" class="form-label">Descripción</label>
              <textarea name="descripction" id="descripction" class="form-control textarea-description"></textarea>
            </div>
          </div>
        </di>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success btn-rounded" id="editar" >Editar</button>
      </div> 
      </form>
    </div>
  </div>
</div>

