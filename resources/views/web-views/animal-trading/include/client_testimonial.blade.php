@php 
use Illuminate\Support\Facades\DB; 
$testimonial = DB::table('testimonials')->where('status',1)->get();
							    
@endphp
@if(count($testimonial)>0)
<section class="testimonials-section">
				<div class="row">
					<div class="col-lg-5">
						<div class="testimonial-heading d-flex">
							<h4> Client
							<br>
							Testimonials</h4>
							<img src="{{ asset('public/assets/animal-trading/assets/img/quotes.png') }}" alt="quotes">
						</div>
					</div>
					<div class="col-lg-7">
						<div class="rightimg"></div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="testimonials-slidersection">
							<div class="owl-nav mynav1"></div>
							<div class="owl-carousel testi-slider">
							    
							    @foreach($testimonial as $test)
								<div class="testimonial-info">
									<div class="testimonialslider-heading d-flex">
										<div class="testi-img">
											<img  onerror="this.src='{{asset('public/assets/back-end/img/160x160/img2.jpg')}}'"
                                                 src="{{asset('storage/app/public/testimonial')}}/{{$test->image}}" class="img-fluid" alt="testi-img">
										</div>
										<div class="testi-author">
											<h6>{{$test->name}}</h6>
											<p>
												{{$test->designation}}
											</p>
										</div>
									</div>
									<div class="testimonialslider-content">
										<p>
											{{$test->description}}
										</p>
									</div>
								</div>
								@endforeach
								
								
							</div>
						</div>
					</div>
				</div>
			</section>
@endif