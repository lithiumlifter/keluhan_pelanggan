<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Keluhan Pelanggan</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="{{ url('assets/css/ready.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/demo.css') }}">
	<link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="index.html" class="logo">
					Keluhan Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				@include('frontend.templates.layouts.navbar')
			</nav>
			</div>
			<div class="sidebar">
				@include('frontend.templates.layouts.sidebar')
			</div>
			<div class="main-panel">
				<div class="content">
					@yield('content')
				</div>
				@include('frontend.templates.layouts.footer')
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p>
						<b>We'll let you know when it's done</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ url('assets/js/core/popper.min.js') }}"></script>
<script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/chartist/chartist.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ url('assets/js/ready.min.js') }}"></script>
<script src="{{ url('assets/js/demo.js') }}"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
@stack('scripts')
</html>