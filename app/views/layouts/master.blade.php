@include('layouts.head')
<div id="wrap">
	<div class="container">
		
		@include('layouts.navigation')

		@yield('content')

	</div>

</div>
	@include('layouts.footer')
@include('layouts.foot')