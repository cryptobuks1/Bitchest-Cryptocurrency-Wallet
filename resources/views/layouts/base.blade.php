@include('partials.header')

@include('includes._nav')

	<div class="container-fluid" style="margin-top: 30px;">

		@yield('content')
		
	</div>

@include('partials.footer')