<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>@yield('title')</title>

		<link rel="shortcut icon" href="{{asset('storage/app/public/company')}}/{{$web_config['fav_icon']->value}}">

		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/css/bootstrap.min.css') }}">

		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/plugins/fontawesome/css/all.min.css') }}">

		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/plugins/select2/css/select2.min.css') }}">
		
		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}">

		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/plugins/aos/aos.css') }}">

		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/css/feather.css') }}">

		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/css/owl.carousel.min.css') }}">

		<link rel="stylesheet" href="{{asset('public/assets/animal-trading/assets/css/style.css') }}">
	</head>
	<body>
		<div class="main-wrapper">
            @include('web-views.animal-trading.partials._header')
			    
			    @yield('content')
			
			@include('web-views.animal-trading.partials._footer')

		</div>
		
		

		<div class="progress-wrap active-progress">
			<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;"></path>
			</svg>
		</div>

		<script src="{{ asset('public/assets/animal-trading/assets/js/jquery-3.6.3.min.js') }}"></script>
		<script src="{{ asset('public/assets/animal-trading/assets/js/bootstrap.bundle.min.js') }}"></script>

		<script src="{{ asset('public/assets/animal-trading/assets/plugins/select2/js/select2.min.js') }}"></script>
		
		<script src="{{ asset('public/assets/animal-trading/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
        <script src="{{ asset('public/assets/animal-trading/assets/plugins/ion-rangeslider/js/custom-rangeslider.js') }}"></script>


		<script src="{{ asset('public/assets/animal-trading/assets/plugins/aos/aos.js') }}"></script>

		<script src="{{ asset('public/assets/animal-trading/assets/js/backToTop.js') }}"></script>

		<script src="{{ asset('public/assets/animal-trading/assets/js/feather.min.js') }}"></script>
		
		<script src="{{ asset('public/assets/animal-trading/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{ asset('public/assets/animal-trading/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

		<script src="{{ asset('public/assets/animal-trading/assets/js/owl.carousel.min.js') }}"></script>

		<script src="{{ asset('public/assets/animal-trading/assets/js/script.js') }}"></script>
	</body>

</html>