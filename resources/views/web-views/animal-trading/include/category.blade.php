@php 
use Illuminate\Support\Facades\DB;
$categories_trading = DB::table('trading_categories')->get();
@endphp
<section class="category-section">
				<div class="container">
					<div class="section-heading">
						<div class="row align-items-center">
							<div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
								<h2>Our <span class="title-left">Cat</span>egory</h2>
								<p>
									Buy and Sell Everything from Used Our Top Category
								</p>
							</div>
							<div class="col-md-6 text-md-end aos aos-init aos-animate" data-aos="fade-up">
								<a href="{{ route('view-all-category') }}" class="btn  btn-view">View All</a>
							</div>
						</div>
					</div>
					<div class="row">
					    @foreach($categories_trading as $tradingcate)
					        @php 
					        
					            $total_product = DB::table('trading_products')->where('status',1)->where('category_ids','like', '%"'.$tradingcate->id.'"%')->get();
					            $total_ads = $total_product->count();
					        
					        @endphp
						<div class="col-lg-2 col-md-3 col-sm-6">
							<a href="#" class="category-links"> <h5>{{$tradingcate->name}}</h5> <span>{{$total_ads}} Ads</span> <img style="width:80px;" src="{{asset('storage/app/public/trading_category')}}/{{$tradingcate->icon}}" alt="icons"> </a>
						</div>
						@endforeach
						
						
					</div>
				</div>
			</section>