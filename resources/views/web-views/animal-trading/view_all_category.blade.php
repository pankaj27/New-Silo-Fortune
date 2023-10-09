@extends('web-views.animal-trading.app')
@php 
use Illuminate\Support\Facades\DB;
$categories_trading = DB::table('trading_categories')->get();
@endphp

@section('title', 'View All Category | Silo Fortune')


@section('content')

<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">View All Category</h2>
                    
            </div>
        </div>
    </div>
</div>

            <div class="categorieslist-section">
				<div class="container">
					<div class="row">
					    @foreach($categories_trading as $tradingcate)
					    @php 
					        
					            $total_product = DB::table('trading_products')->where('status',1)->where('category_ids','like', '%"'.$tradingcate->id.'"%')->get();
					            $total_ads = $total_product->count();
					        
					    @endphp
						<div class="col-lg-3 col-md-4">
							<div class="categories-content">
								<a href="#" class="text-center aos aos-init aos-animate" data-aos="fade-up"> <img style="width:80px;" src="{{asset('storage/app/public/trading_category')}}/{{$tradingcate->icon}}" alt="car1"> <h6>{{$tradingcate->name}}</h6> <span class="ads">{{$total_ads}} Ads</span> </a>
							</div>
						</div>
					   @endforeach
						
					</div>
				</div>
			</div>

@endsection