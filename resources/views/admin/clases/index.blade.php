@extends('admin.template.main')

@section('title', 'Clases')

@section('contend')

@push('css')
  <link rel="stylesheet" href="{{asset('plugins/trumbowyg/ui/trumbowyg.css')}}">
@endpush
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin-bottom: 5px;">
                    <div class="col-md-4">
                       <h4 class="card-title">Listado de Clases</h4>
                    </div>
                    <div class="col-md-8 text-right">
                        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#create_class">
                           Nuevo
                          <i class="mdi mdi-plus-circle"></i>
                        </button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table_index_class" style="width: 100%;" >
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

          @include('admin.clases.create')
          @include('admin.clases.show')
          @include('admin.clases.edit')
@endsection

@push('js')
@include('plugins.datatable')
<script src="{{asset('plugins/trumbowyg/trumbowyg.js')}}"></script>
<script> 
      $(".textarea-description").trumbowyg({
      });
</script>
@include('admin.clases.js.index')
@endpush

