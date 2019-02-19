@extends('admin.template.main')

@section('title', 'Practicas')

@section('contend') 
         <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin-bottom: 5px;">
                    <div class="col-md-4">
                       <h4 class="card-title">Practicas Pendientes</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table_index_practicas" style="width: 100%;" >
                          <thead>
                            <tr>
                              <th>Título</th>
                              <th>Fecha</th>
                              <th>Opciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div> <!--Final del card-body -->  
         	    </div> <!--Final del card --> 
            </div> <!--Final de col --> 
          </div> <!--Final de row --> 
      
        @include('student.practicas.show')
@endsection
@push('js')
@include('plugins.datatable')
<script src="{{asset("plugins/upload-preview/jquery.uploadPreview.min.js")}}"></script>
 @include('student.practicas.js.index')
@endpush
