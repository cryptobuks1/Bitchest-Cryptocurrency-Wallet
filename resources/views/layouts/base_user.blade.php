@include('partials.header')

@include('AdminUsers.partials.sidenav')

	<main class="container-fluid" style="margin-top: 30px;">

		@yield('content')
		
	</main>

@include('partials.footer')