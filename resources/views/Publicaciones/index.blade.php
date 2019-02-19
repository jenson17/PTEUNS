           <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="fluid-container">
                    <div class="row ticket-card">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="{{asset('plugins/images/faces/default.jpg')}}"  alt="profile image"> 
                      </div>
                      <div class="ticket-details col-md-11">
                         <form id="form_publicacion_create" enctype="multipart/form-data" method="POST" action="{{url('/publicacion')}}">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <textarea id="publicacion" name="publicacion" type="text" class="form-control" placeholder="¿Qué estas pensando?" rows="4"></textarea>
                          </div>
                          <div class="form-group">
                             <input type="file" id="foto_video" name="foto_video" class="form-control">
                          </div>
                          <div class="form-group">
                            <input type="submit" name="enviar_publi" class="btn btn-primary" value="Compartir">
                          </div>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>    
            </div> 
          </div>   
          
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="fluid-container">
                    
                    @foreach($publis as $publi)
                        <h5 class="card-title mb-4">Publicacion</h5>
                        <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="{{asset('plugins/images/faces/default.jpg')}}"  alt="profile image">
                        
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-justify"><b>{{$publi->name}} : </b>
                            {{$publi->publicacion}}.</p>
                        </div>
                       
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-8 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Feha y hora:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted">{{ $publi->created_at}}</small>
                          </div>
                          
                        </div>
                      </div> 
                      @if($publi->user_id == Auth::user()->id )
                          <div class="ticket-actions col-md-2">
                            <div class="btn-group dropdown">
                              <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item editar_pulicacion" href="{{$publi->id}}">
                                  <i class="fa fa-reply fa-fw"></i>Editar</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item eliminar_publicacion" href="{{$publi->id}}">
                                  <i class="fa fa-check text-success fa-fw"></i>Eliminar</a>
                              
                              </div>
                            </div>
                          </div>
                      @endif
                    </div> 
                    <h5 class="card-title mb-4">Comentarios</h5>
                    @foreach($comen as $con)

                        @if($con->publicacion_id ==  $publi->id)
                          
                          
                      <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="{{asset('plugins/images/faces/default.jpg')}}"  alt="profile image">
                        
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-justify"><b>{{$con->name}} : </b>
                            {{$con->comentario}}.</p>
                        </div>
                       
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-8 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Feha y hora:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted">{{ $con->created_at}}</small>
                          </div>
                          
                        </div>
                      </div> 
                      @if($con->user_id == Auth::user()->id )
                          <div class="ticket-actions col-md-2">
                            <div class="btn-group dropdown">
                              <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item editar_comentario" href="{{$con->id}}">
                                  <i class="fa fa-reply fa-fw"></i>Editar</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item eliminar_comentario" href="{{$con->id}}">
                                  <i class="fa fa-check text-success fa-fw"></i>Eliminar</a>
                              
                              </div>
                            </div>
                          </div>
                      @endif
                    </div> 
                         

                        @endif

                    @endforeach


                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="{{asset('plugins/images/faces/default.jpg')}}"  alt="profile image">
                        
                      </div>
                      <div class="ticket-details col-md-11">
                        <form id="{{$publi->id}}" class="comentario" method="POST" action="{{url('/comentarios')}}">
                          <div class="form-group">
                            {{ csrf_field() }}
                            <input type="hidden" name="publicacion_id" id="publicacion_id_{{$publi->id}}" value="{{$publi->id}}">
                            <textarea type="text" id="comentario_{{$publi->id}}" name="comentario" class="form-control" placeholder="Escribe un comentario"></textarea>
                          </div>
                          <div class="form-group">
                            <input type="submit" name="enviar_coment" class="btn btn-primary" value="Publicar">
                          </div>
                        </form>
                      </div> 
                    </div>
                    @endforeach

                  </div>
                </div>
              </div>    
            </div>  