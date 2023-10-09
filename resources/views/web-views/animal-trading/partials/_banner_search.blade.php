<?php use Illuminate\Support\Facades\DB;
$categories_trading = DB::table('trading_categories')->get();
?>
<section class="banner-section">
				<div class="banner-circle">
					<img src="{{ asset('public/assets/animal-trading/assets/img/bannerbg.png') }}" class="img-fluid" alt="bannercircle">
				</div>
				<div class="container">
					<div class="home-banner">
						<div class="row align-items-center">
							<div class="col-lg-7">
								<div class="section-search aos" data-aos="fade-up">
									<p class="explore-text">
										<span>Indias most popular</span>
									</p>
									<img src="{{ asset('public/assets/animal-trading/assets/img/arrow-banner.png') }}" class="arrow-img" alt="arrow">
									<h1>Cow, Cattle & Buffalo Trading Platform 
									<br>
									<span>Sell, Buy</span> & Find </h1>
									<p>
										Most loved and trusted classified ad listing cattle classified ad.Browse thousand of items near you.
									</p>
									<div class="search-box">
										<form action="{{ route('search-by-category') }}" class="d-flex" method="post">
										    @csrf
											<div class="search-input line">
												<div class="form-group">
													<select class="form-control select category-select" required="required">
														<option value>Choose Category</option>
														@foreach($categories_trading as $tradingcate)
														    <option value="{{$tradingcate->id}}">{{$tradingcate->name}}</option>
														@endforeach
														
													</select>
												</div>
											</div>
											<div class="search-input">
												<div class="form-group">
													<div class="group-img">
														<input type="text" class="form-control" placeholder="Choose Location" required="required">
														<i class="feather-map-pin"></i>
													</div>
												</div>
											</div>
											<div class="search-btn">
												<button class="btn btn-primary" type="submit">
													<i class="fa fa-search" aria-hidden="true"></i> Search
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="banner-imgs">
									<img src="{{ asset('public/assets/animal-trading/assets/img/Right-img.png') }}" class="img-fluid" alt="bannerimage">
								</div>
							</div>
						</div>
					</div>
				</div>
				<img src="{{ asset('public/assets/animal-trading/assets/img/bannerellipse.png') }}" class="img-fluid banner-elipse" alt="arrow">
				<img src="{{ asset('public/assets/animal-trading/assets/img/banner-arrow.png') }}" class="img-fluid bannerleftarrow" alt="arrow">
			</section>