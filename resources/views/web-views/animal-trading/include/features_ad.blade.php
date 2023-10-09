@php 
use Illuminate\Support\Facades\DB; 
@endphp
<section class="featured-section">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
							<div class="section-heading">
								<h2>Featu<span class="title-right">red</span> Ads</h2>
								<p>
									Checkout these latest coo ads from our members
								</p>
							</div>
						</div>
						<div class="col-md-6 text-md-end aos" data-aos="fade-up">
							<div class="owl-nav mynav2"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="owl-carousel featured-slider grid-view">
							    @foreach($featured_items as $items)
							    
							    @php
							     $category_ids = json_decode($items->category_ids);
							     foreach($category_ids as $dd){ $catee = (array)$dd; $categoryidd = $catee['id'];  } 
							     $category_name = DB::table('trading_categories')->where('id',$categoryidd)->first();
							     $city_name = DB::table('cities')->where('id',$items->location)->first();
							     
							     $state_name = DB::table('states')->where('id',$city_name->state_id)->first();
							     
							     $seller_info = DB::table('users')->where('id',$items->seller_id)->first();
							     
							     
							     @endphp
							    
							    
							    
								<div class="card aos" data-aos="fade-up">
									<div class="blog-widget">
										<div class="blog-img">
											<a href="{{ route('details-item-view',['slug'=>$items->slug])}}"> <img style="height:208px;" src="{{\App\CPU\ProductManager::trading_product_image_path('thumbnail')}}/{{$items->thumbnail}}" class="img-fluid" alt="blog-img"> </a>
											<div class="fav-item">
												<span class="Featured-text">Featured</span>
												<a href="javascript:void(0)" class="fav-icon"> <i class="feather-heart"></i> </a>
											</div>
										</div>
										<div class="bloglist-content">
											<div class="card-body">
												<div class="blogfeaturelink">
													<div class="grid-author">
														<img 
														    src="{{asset('storage/app/public/profile/'.$seller_info->image)}}"
                                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
														alt="author">
													</div>
													<div class="blog-features">
														<a href="javascript:void(0)"><span> <i class="fa-regular fa-circle-stop"></i> {{$category_name->name}}</span></a>
													</div>
													<div class="blog-author text-end">
														<span> <i class="feather-eye"></i>1K </span>
													</div>
												</div>
												<h6><a href="{{ route('details-item-view',['slug'=>$items->slug])}}">{{$items->name}}</a></h6>
												<div class="blog-location-details">
													<div class="location-info">
														<i class="feather-map-pin"></i> {{$city_name->name}}, {{$state_name->name}}
													</div>
													<div class="location-info">
														<i class="fa-regular fa-calendar-days"></i>{{date('d M, Y', strtotime($items->created_at))}}
													</div>
												</div>
												<div class="amount-details">
													<div class="amount">
														<span class="validrate">{{\App\CPU\Helpers::currency_converter($items->unit_price)}}</span>
														<!--<span>$450</span>-->
													</div>
													<!--<div class="ratings">
														<span>4.7</span> (50)
													</div>-->
													<div class="ratings">
														<a href="{{ route('details-item-view',['slug'=>$items->slug])}}"><span>Explore More</span></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
								
								
							</div>
						</div>
					</div>
				</div>
			</section>