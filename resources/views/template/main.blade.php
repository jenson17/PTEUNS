<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Default')</title>
	<!-- plugins:css -->
  	<link rel="stylesheet" href="{{ asset('plugins/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  	<!-- endinject -->
  	<!-- End plugin css for this page -->
  	<!-- inject:css -->
  	<link rel="stylesheet" href="{{ asset('plugins/css/style.css') }}">
  	<!-- endinject -->
  	<link rel="shortcut icon" href="{{ asset('plugins/images/favicon.png') }}"/>
</head>
<body>
	
		@yield('contend')
			 
	  <!-- plugins:js -->
   	<script src="{{ asset('plugins/vendors/js/vendor.bundle.base.js')}} "></script>
  	<!-- endinject -->
    <script src="{{ asset('plugins/js/misc.js') }}"></script>

    @stack('js')
</body>
</html>