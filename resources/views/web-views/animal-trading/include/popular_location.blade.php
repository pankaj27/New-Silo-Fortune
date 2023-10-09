@php 
use Illuminate\Support\Facades\DB; 
$location = DB::table('trading_products')->select('location')->where('status',1)->distinct()->get();
@endphp
<section class="popular-locations">
				<div class="popular-circleimg">
					<img class="img-fluid" src="{{ asset('public/assets/animal-trading/assets/img/popular-img.png') }}" alt="Popular-sections">
				</div>
				<div class="container">
					<div class="section-heading">
						<h2>Popular <span>Loc</span>ations</h2>
						<p>
							Start by selecting your favuorite location and explore the goods
						</p>
					</div>
					<div class="location-details d-flex">
						<div class="row">
						    
						    @foreach($location as $items)
						    @php 
						        $citiesname = DB::table('cities')->where('id',$items->location)->first();
						    @endphp
						    
							<div class="location-info col-lg-4 col-md-6">
								<div class="location-info-details d-flex align-items-center">
									<div class="location-img">
										<a href="{{route('search-by-location',$items->location)}}"><img class="img-fluid" src="{{ asset('public/assets/animal-trading/assets/img/locations/usa.jpg') }}" alt="locations"></a>
									</div>
									<div class="location-content">
										<a href="{{route('search-by-location',$items->location)}}">{{$citiesname->name}}</a>
										<p>
											20+ Ads Posted
										</p>
										<a href="{{route('search-by-location',$items->location)}}}}" class="view-detailsbtn">View Details</a>
									</div>
								</div>
							</div>
							
							@endforeach
							
						</div>
					</div>
					<div class="align-items-center">
						<a href="{{route('search-by-all-location')}}}}" class="browse-btn">Browse Ads</a>
					</div>
				</div>
			</section>