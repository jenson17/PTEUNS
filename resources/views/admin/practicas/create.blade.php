<div class="modal fade" id="create_practica_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Subir Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" action="{{ url("/admin/practicas") }}" method="POST" id="form_practica_create">
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
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Asociar a una clase</label>
              <select name="clase_id" id="clase_id" class="form-control">
                <option value=""></option>
                @foreach ($clases as $clase)
                  <option value="{{$clase->id}}">{{$clase->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group image-preview">
                <label for="image-upload" class="image-label text-primary">Cargar Imagen</label>
                <input id="image-upload" name="file_upload" type="file" required="">
            </div>
          </div>
        </di>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-rounded" id="enviar_practica_foto" >Enviar</button>
      </div> 
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="create_practica_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Subir Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" action="{{ url("/admin/practicas") }}" method="POST" id="form_practicavideo_create">
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
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Asociar a una clase</label>
              <select name="clase_id" id="clase_id" class="form-control">
                <option value=""></option>
                @foreach ($clases as $clase)
                  <option value="{{$clase->id}}">{{$clase->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group video-preview">
                <label for="video-upload" class="video-label text-primary">Cargar Video</label>
                <br>
                <input id="video_upload" name="video_upload" type="file" required="">
            </div>
          </div>
        </di>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-rounded" id="enviar_practica_video" >Enviar</button>
      </div> 
      </form>
    </div>
  </div>
</div>

