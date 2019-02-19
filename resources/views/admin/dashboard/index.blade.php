@extends('admin.template.main')

@section('title', 'Dashboard')

@section('contend')
          
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <a href="{{ route('contenidos.index') }}" style="text-decoration: none;" >
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-content-copy text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                          <p class="font-weight-medium mb-0 text-center">
                            Contenidos
                          </p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Panel de contenidos
                  </p>
                </div>
              </div>
              </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <a href="{{ route('clases.index') }}" style="text-decoration: none;" >
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-note-multiple-outline text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="font-weight-medium mb-0 text-center">Mis Clases</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                     <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Panel de clases
                  </p>
                </div>
              </div>
              </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <a href="{{ route('evaluaciones.index') }}" style="text-decoration: none;" >
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                       <i class="mdi mdi-clipboard-outline text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="font-weight-medium mb-0 text-center">Evaluaciones</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                     <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Panel de evaluaciones
                  </p>
                </div>
              </div>
              </a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
             <a href="{{ route('practicas.index') }}" style="text-decoration: none;" >
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-flask text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-left">Practicas y Experimentos</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                     <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Panel
                  </p>
                </div>
              </div>
             </a>
            </div>
          </div>
          
         
         @include('publicaciones.index') 
         @include('publicaciones.show')
         @include('publicaciones.showcomentario')  
                
               
@endsection
@push('js')
     @include('publicaciones.js.index') 
@endpush


