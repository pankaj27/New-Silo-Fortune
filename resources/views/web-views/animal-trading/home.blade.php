@extends('web-views.animal-trading.app')

@section('title', 'Animal Trading | Silo Fortune')

@section('content')

            
			@include('web-views.animal-trading.partials._banner_search')

			@include('web-views.animal-trading.include.category')

            @include('web-views.animal-trading.include.features_ad')

			@include('web-views.animal-trading.include.popular_location')

            @include('web-views.animal-trading.include.latest_add')

			

			

			

			<section class="cta-section">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-7">
							<div class="cta-content">
								<h3>Earn Cash by <span>Selling</span>
								<br>
								or Find Anything you desire </h3>
								<p>
									There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humo or randomised words which don't look even slightlys
								</p>
								<div class="cta-btn">
									<a href="#" class="btn-primary postad-btn">Post Your Ads</a>
									<a href="#" class="browse-btn">Browse Ads</a>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="cta-img">
								<img src="{{ asset('public/assets/animal-trading/assets/img/cta-img.png') }}" class="img-fluid" alt="CTA">
							</div>
						</div>
					</div>
				</div>
			</section>

			@include('web-views.animal-trading.include.client_testimonial')


			

			
            
		
            @include('web-views.animal-trading.partials._footer')
			
@endsection
