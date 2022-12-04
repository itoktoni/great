<!doctype html>
<html lang="en">

<head>
	@include('layouts.meta')
	@yield('head')

	<link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">

	@yield('css')
	@shared
</head>

<body class="fixed {{ !(Template::greatherAdmin()) ? 'navigation-toggle-one' : '' }}">

	@include('layouts.header')

	<div id="main" hx-boost="true">

		<div class="navigation" id="pjax">

			@include('layouts.left')

		</div>

		<div class="main-content">

			@yield('container')

		</div>

		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content" id="modal-body">
				</div>
			</div>
		</div>

	</div>

	<script src="{{ url('assets/js/app.min.js') }}"></script>

	@stack('footer')

	@include('layouts.alert')

</body>

</html>