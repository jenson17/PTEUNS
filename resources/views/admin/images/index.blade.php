@extends('admin.template.main')

@section('title', 'Fotos')
@push('css')
      <style>
      /* Upload Preview */
    .image-preview {
        width: 100%;
        height: 400px;
        position: relative;
        overflow: hidden;
        background-color: #ffffff;
        color: #ecf0f1;
    }
    .image-preview input {
        line-height: 200px;
        font-size: 200px;
        position: absolute;
        opacity: 0;
        z-index: 10;
    }
    .image-preview label {
        position: absolute;
        z-index: 5;
        opacity: 0.8;
        cursor: pointer;
        background-color: #bdc3c7;
        width: 180px;
        height: 40px;
        font-size: 18px;
        line-height: 42px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        text-align: center;
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
                       <h4 class="card-title">Fotos de la clase</h4>
                    </div>
                    <div class="col-md-8 text-right">
                        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#create_image">
                           Agregar
                          <i class="mdi mdi-plus-circle"></i>
                        </button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table_index_fotos" style="width: 100%;" >
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
      
        @include('admin.images.create')
        @include('admin.images.show')
@endsection
@push('js')
@include('plugins.datatable')
<script src="{{asset("plugins/upload-preview/jquery.uploadPreview.min.js")}}"></script>
@include('admin.images.js.index')
@endpush



