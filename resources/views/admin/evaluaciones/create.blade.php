<div class="modal fade" id="create_prueba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Crear Evaluación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('evaluaciones.store')}}" method="POST" id="form_prueba_create">
        {{ csrf_field() }}
      <div class="modal-body">
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Nombre</label>
              <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Nombre">
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
            <div class="form-group">
              <label for="" class="form-label">Selección Simple</label>
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  @for($j=1; $j<=9; $j++)
                       <li class="nav-item">
                          @if($j == 1)
                              <a class="nav-link active" id="pills-{{$j}}-tab" data-toggle="pill" href="#pills-{{$j}}" role="tab" aria-controls="pills-{{$j}}" aria-selected="true">{{$j}}</a>
                          @else
                              <a class="nav-link" id="pills-{{$j}}-tab" data-toggle="pill" href="#pills-{{$j}}" role="tab" aria-controls="pills-{{$j}}" aria-selected="true">{{$j}}</a>
                          @endif
                        </li>
                  @endfor
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  @for ($i=1; $i <=9 ; $i++)
                      @if($i == 1 )
                         <div class="tab-pane fade show active" id="pills-{{$i}}" role="tabpanel" aria-labelledby="pills-{{$i}}-tab">
                      @else
                         <div class="tab-pane fade" id="pills-{{$i}}" role="tabpanel" aria-labelledby="pills-{{$i}}">
                      @endif
                        <div class="form-group">
                         <input type="text" name="pregunta{{$i}}" id="pregunta{{$i}}-tab" class="form-control" placeholder="Pregunta Nº {{$i}}">
                       </div>
                        <div class="form-group">
                          <div class="input-group">
                                <input type="text" class="form-control" name="res{{$i}}[]" placeholder="Respuesta 1">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input type="radio"  checked="" name="radio{{$i}}" value="0">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="res{{$i}}[]" placeholder="Respuesta 2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <input type="radio" name="radio{{$i}}" value="1">
                                  </span>
                                </div>
                            </div>
                             <div class="input-group">
                                <input type="text" class="form-control" name="res{{$i}}[]" placeholder="Respuesta 3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input type="radio" name="radio{{$i}}" value="2">
                                  </span>
                                </div>
                            </div>
                             <div class="input-group">
                                <input type="text" class="form-control" name="res{{$i}}[]" placeholder="Respuesta 4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <input type="radio" name="radio{{$i}}" value="2">
                                  </span>
                                </div>
                            </div>
                             <div class="input-group">
                                <input type="text" class="form-control" name="res{{$i}}[]" placeholder="Respuesta 5">
                                <div class="input-group-prepend" >
                                  <span class="input-group-text" id="basic-addon1">
                                    <input type="radio" name="radio{{$i}}" value="4">
                                  </span>
                                </div>
                            </div>
                        </div> 
                    </div>
                  @endfor
                </div>
            </div>
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

