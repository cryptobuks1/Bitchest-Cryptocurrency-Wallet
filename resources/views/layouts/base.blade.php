@include('partials.header')

@include('includes._nav')

	<main class="container-fluid" style="margin-top: 30px;">

		@yield('content')
		
	</main>

@include('partials.footer')