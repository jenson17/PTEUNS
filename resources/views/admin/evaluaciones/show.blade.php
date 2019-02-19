<div class="modal fade" id="show_prueba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Ver Evaluación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_prueba_show">
      <div class="modal-body">
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label"><b>Nombre</b></label>
              <br>
              <label id="titulo" class="form-label form-control"></label>
            </div>
          </div>
        </di>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label"><b>Clase Asociada</b></label>
              <br>
              <label for="" class="form-label form-control" id="clase_id"></label>
              </select>
            </div>
          </div>
        </di>
         <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label"><b>Status</b></label>
              <div id="status"></div>
            </div>
          </div>
        </di>
         <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                <div id="jenson">
                  
                </div>
              </div>
           </div>
         </div>
        <di class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="" class="form-label">Respuestas</label>
              <ul class="nav nav-pills mb-3" id="pills-tab-item" role="tablist">
                  @for($j=0; $j<=8; $j++)
                      
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
                  @for ($i=0; $i <=8 ; $i++)
                      @if($i == 0 )
                         <div class="tab-pane fade show active" id="pills-{{$i}}-valor" role="tabpanel" aria-labelledby="pills-{{$i}}-item">
                      @else
                         <div class="tab-pane fade" id="pills-{{$i}}-valor" role="tabpanel" aria-labelledby="pills-{{$i}}-item">
                      @endif
                        <div class="form-group">
                         <label for="" class="form-label form-control pregunta" id="pregunta_{{$i}}"></label>
                       </div>
                        <div class="form-group">
                          <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_0"></label>
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input disabled="" type="radio" id="radio_{{$i}}_0" name="item_radio{{$i}}" value="0">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_1"></label>
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input disabled="" type="radio" id="radio_{{$i}}_1" name="item_radio{{$i}}" value="1">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_2"></label>
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input disabled="" type="radio" id="radio_{{$i}}_2" name="item_radio{{$i}}" value="2">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_3"></label>
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input disabled="" type="radio" id="radio_{{$i}}_3" name="item_radio{{$i}}" value="3">
                                  </span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="" class="form-control" id="item_{{$i}}_4"></label>
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                     <input disabled="" type="radio" id="radio_{{$i}}_4" name="item_radio{{$i}}" value="4">
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
