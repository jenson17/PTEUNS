            <div class="modal fade" id="edit_contend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Contenido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     {!! Form::open(['method' => 'PUT', 'class' =>'form-sample', 'id' => 'form_contend_edit' ]) !!}   
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group ">
                                {!! Form::label('name', 'Nombre') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'id' => 'name']) !!}
                            </div>
                        </div>   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {!! Form::submit('Editar',['class' =>'btn btn-success btn-rounded', 'id' => 'editar' ]) !!}  
                  </div>
                    {!! Form::close() !!}
                </div>
              </div>
            </div>



