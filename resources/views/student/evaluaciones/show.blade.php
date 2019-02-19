<div class="modal fade" id="show_prueba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="{{route('evaluacion.store')}}" method="POST" id="form_prueba_show">
       {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="" class="form-label">Segundos </label>
               <div id="tiempo" style="background: red; color: white; border-radius: 5px; padding: 5px 20px;"></div>
            </div>
          </div>
        </div>
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Evaluación de la clase :</label>
              <br>
              <label for="" class="form-label" id="clase_id"></label>
              <input type="hidden" name="evaluacion_id" id="evaluacion_id">
              <input type="hidden" name="clase_id" id="clas_id">
            </div>
          </div>
        </di>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Preguntas de selección simple</label>
              <ul class="nav nav-pills mb-3" id="pills-tab-item" role="tablist">
                  @for($j=0; $j<=4; $j++)
                      
                      <?php 
                          $k = $j;
                          $k++;
                      ?>
  
                       <li class="nav-item">
                          @if($j == 0)
                              <a class="nav-link active" id="pills-{{$j}}-item" data-toggle="pill" href="#pills-{{$j}}-valor" role="tab" aria-controls="pills-{{$j}}-con" aria-selected="true">{{$k}}</a>
                          @else
                              <a class="nav-link" id="pills-{{$j}}-item" data-toggle="pill" href="#pills-{{$j}}-valor" role="tab" aria-controls="pills-{{$j}}-con" aria-selected="true">{{$k}}</a>
                          @endif
                        </li>
                  @endfor
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  @for ($i=0; $i <=4 ; $i++)
                      @if($i == 0 )
                         <div class="tab-pane fade show active" id="pills-{{$i}}-valor" role="tabpanel" aria-labelledby="pills-{{$i}}-item">
                      @else
                         <div class="tab-pane fade" id="pills-{{$i}}-valor" role="tabpanel" aria-labelledby="pills-{{$i}}-item">
                      @endif
                        <div class="form-group">
                         <label for="" class="form-label form-control pregunta" id="pregunta_{{$i}}"></label>
                         <input type="hidden" name="pregunta{{$i}}" id="preg_{{$i}}">
                       </div>
                        <div class="form-group">
                          <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_0"></label>
                                <input type="hidden" name="res{{$i}}[]" id="res_{{$i}}_0">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input type="radio" id="radio_{{$i}}_0" name="radio{{$i}}" value="0">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_1"></label>
                                 <input type="hidden" name="res{{$i}}[]" id="res_{{$i}}_1">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input  type="radio" id="radio_{{$i}}_1" name="radio{{$i}}" value="1">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_2"></label>
                                 <input type="hidden" name="res{{$i}}[]" id="res_{{$i}}_2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input  type="radio" id="radio_{{$i}}_2" name="radio{{$i}}" value="2">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_3"></label>
                                 <input type="hidden" name="res{{$i}}[]" id="res_{{$i}}_3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input  type="radio" id="radio_{{$i}}_3" name="radio{{$i}}" value="3">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_4"></label>
                                <input type="hidden" name="res{{$i}}[]" id="res_{{$i}}_4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input  type="radio" id="radio_{{$i}}_4" name="radio{{$i}}" value="4">
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
        </div>
      </form>
    </div>
  </div>
</div>