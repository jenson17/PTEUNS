@extends('admin.template.main')

@section('title', 'Dashboard')

@section('contend')
          
           @include('publicaciones.index') 
           @include('publicaciones.show') 
           @include('publicaciones.showcomentario')
                
@endsection
@push('js')
     @include('publicaciones.js.index')
@endpush