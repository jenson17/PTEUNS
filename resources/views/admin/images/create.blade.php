<div class="modal fade" id="create_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Crear Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" action="{{ url("/admin/clases/{$clas_id}/fotos") }}" method="POST" id="form_images_create">
       {{ csrf_field() }}
      <div class="modal-body">
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Título</label>
              <br>
              <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo">
            </div>
          </div>
        </di>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group image-preview">
                <label for="image-upload" class="image-label text-primary">Cargar imagen</label>
                <input id="image-upload" name="file_upload" type="file" accept="image/*"/>
            </div>
          </div>
        </di>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-rounded" id="enviar_foto" >Enviar</button>
      </div> 
      </form>
    </div>
  </div>
</div>
