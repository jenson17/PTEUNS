@extends('admin.template.main')

@section('title', 'Contenidos')

@section('contend')
          
         <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <div class="row" style="margin-bottom: 5px;">
                    <div class="col-md-4">
                       <h4 class="card-title">Listado de contenidos</h4>
                    </div>
                    <div class="col-md-8 text-right">
                        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#create_contend">
                           Nuevo
                          <i class="mdi mdi-plus-circle"></i>
                        </button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table_index_contend" style="width: 100%;" >
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
      

          @include('admin.contenidos.create')
          @include('admin.contenidos.edit')
@endsection

@push('js')
@include('plugins.datatable')
@include('admin.contenidos.js.index')
@endpush



