<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title','Default')</title>

	<!-- plugins:css -->
  	<link rel="stylesheet" href="{{ asset('plugins/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  	<!-- End plugin css for this page -->
  	<!-- inject:css -->
  	<link rel="stylesheet" href="{{ asset('plugins/css/style.css') }}">
  	<!-- endinject -->
  	<link rel="shortcut icon" href="{{ asset('plugins/images/favicon.png') }}"/>

  	<link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('plugins/sweetalert/css/sweetalert.min.css') }}">

  	@stack('css')
</head>
<body>
	@include('admin.template.partials.navbar')

	@include('admin.template.partials.sidebar')
	
	<div class="main-panel">
        <div class="content-wrapper">
    
   			 @yield('contend')
   		
        </div>
  	@include('users.edit_user')
  	@include('users.create')
  	@include('users.show')
  	@include('student.clases.show')
	@include('admin.template.partials.footer')
	
	<!-- container-scroller -->
	<!-- plugins:js -->
	<script src="{{ asset('plugins/vendors/js/vendor.bundle.base.js') }}"></script>
	<script src="{{ asset('plugins/js/misc.js') }}"></script>
	<!-- End custom js for this page-->
	<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
	<script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
	@stack('js')
</body>
</html>