<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- PWA -->
    <link rel="manifest" href="{{ asset('pwa/manifest.json') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="PWAGram">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-57x57.png') }}" sizes="57x57">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-60x60.png') }}" sizes="60x60">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-72x72.png') }}" sizes="72x72">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-76x76.png') }}" sizes="76x76">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-114x114.png') }}" sizes="114x114">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-120x120.png') }}" sizes="120x120">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-144x144.png') }}" sizes="144x144">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-152x152.png') }}" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ asset('pwa/images/icons/apple-icon-180x180.png') }}" sizes="180x180">
    <meta name="msapplication-TileImage" content="{{ asset('pwa/images/icons/app-icon-144x144.png') }}">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#3f51b5">

	<!--favicon-->
	<link rel="icon" href="{{ asset('adminbackend/assets/images/favicon-32x32.png') }}" type="image/png" />
	<!-- Input Tags -->
    <link href="{{ asset('adminbackend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
	<!--plugins-->
	<link href="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
	<link href="{{ asset('adminbackend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('adminbackend/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('adminbackend/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('adminbackend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	
	<link href="{{ asset('adminbackend/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('adminbackend/assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('adminbackend/assets/css/dark-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('adminbackend/assets/css/semi-dark.css') }}" />
	<link rel="stylesheet" href="{{ asset('adminbackend/assets/css/header-colors.css') }}" />
    <!-- Toaster CSS  -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
	<!-- TData Table CSS  -->
	<link href="{{ asset('adminbackend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- FontAwsome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title>MVE Admin Dashboard</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->

		  @include('admin.body.sidebar')

		<!--end sidebar wrapper -->
		<!--start header -->
		@include('admin.body.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">

			  @yield('admin')


		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		
     @include('admin.body.footer')
     
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr/>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr/>
			<h6 class="mb-0">Header Colors</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>

			<hr/>
			<h6 class="mb-0">Sidebar Backgrounds</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('adminbackend/assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins -->
	<script src="{{ asset('adminbackend/assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/jquery-knob/excanvas.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
	
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
	  <script src="{{ asset('adminbackend/assets/js/index.js') }}"></script>
	<!--app JS-->
	<script src="{{ asset('adminbackend/assets/js/app.js') }}"></script>
    <!--Frontend Validation JS-->
	<script src="{{ asset('adminbackend/assets/js/validate.min.js') }}"></script>

    <!-- PWA -->
    <script src="{{ asset('pwa/js/registerSW.js') }}"></script>

    <!-- End PWA -->


    <!--Datatable JS-->
	<script src="{{ asset('adminbackend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('adminbackend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#example2').DataTable();
		  } );
		 
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				
				select: true,
				dom: 'Blfrtip',
				lengthChange: true,
								
				buttons: [ 'copy', 'csv','excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

    <!--Toaster JS -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
		@if(Session::has('message'))
		var type = "{{ Session::get('alert-type','info') }}"
		switch(type){
			case 'info':
			toastr.info(" {{ Session::get('message') }} ");
			break;
			case 'success':
			toastr.success(" {{ Session::get('message') }} ");
			break;
			case 'warning':
			toastr.warning(" {{ Session::get('message') }} ");
			break;
			case 'error':
			toastr.error(" {{ Session::get('message') }} ");
			break; 
		}
		@endif 
    </script>
	
	<!-- Delete Alert Sweet alert-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>        
	<script src="{{ asset('adminbackend/assets/js/code.js') }}"></script>

   <!-- Tags Input-->
	<script src="{{ asset('adminbackend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

  <!-- Text Editor Tinymce-->	
 	<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
	</script>

	<script>
		tinymce.init({
		  selector: '#mytextarea'
		});
	</script>
</body>

</html>