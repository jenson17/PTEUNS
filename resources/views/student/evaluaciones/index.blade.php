@extends('admin.template.main')

@section('title', 'Evaluaciones')

@push('css')
  <style>
    ul > li > a.nav-link{
      padding: 10px 43px;
    }
    .badge{
      padding: 10px 10px;
      font-size: 14px;
    }
  </style>
@endpush
@section('contend')
          
         <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <div class="row" style="margin-bottom: 5px;">
                    <div class="col-md-4">
                       <h4 class="card-title">Evaluaciones Pendientes</h4>
                    </div>
                    <div class="col-md-8 text-right">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table_index_pruebas" style="width: 100%;" >
                          <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Opciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot></tfoot>
                        </table>
                      </div>
                    </div>
                  </div>

                </div> <!--Final del card-body -->  
         	    </div> <!--Final del card --> 
            </div> <!--Final de col --> 
          </div> <!--Final de row --> 
      
          @include('student.evaluaciones.show')
@endsection

@push('js')
@include('plugins.datatable')
@include('student.evaluaciones.js.index')
@endpush
