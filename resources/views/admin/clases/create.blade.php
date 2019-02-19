<div class="modal fade" id="create_class" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Crear Clase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('clases.store')}}" method="POST" id="form_class_create">
       {{ csrf_field() }}
      <div class="modal-body">
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Nombre</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Nombre">
            </div>
          </div>
        </di>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Asociar a un contenido</label>
              <select name="contend_id" id="contend_id" class="form-control">
                <option value=""></option>
                @foreach ($contends as $contend)
                  <option value="{{$contend->id}}">{{$contend->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </di>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Descripción</label>
              <textarea name="descripction" id="descripction" class="form-control textarea-description" ></textarea>
            </div>
          </div>
        </di>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-rounded" id="enviar_class" >Enviar</button>
      </div> 
      </form>
    </div>
  </div>
</div>
