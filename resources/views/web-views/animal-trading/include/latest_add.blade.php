@php 
use Illuminate\Support\Facades\DB; 
@endphp
<section class="latestad-section grid-view featured-slider">
				<div class="container">
					<div class="section-heading">
						<div class="row align-items-center">
							<div class="col-md-6 aos aos-init aos-animate" data-aos="fade-up">
								<h2>Lat<span class="title-right">est</span> Ads</h2>
								<p>
									checkout these latest cattle,buffalo,ship uploaded
								</p>
							</div>
							<div class="col-md-6 text-md-end aos aos-init aos-animate" data-aos="fade-up">
								<a href="{{route('view-all-ads')}}" class="btn  btn-view">View All</a>
							</div>
						</div>
					</div>
					<div class="lateestads-content">
						<div class="row">
						     @foreach($latest_product as $items)
						     @php
							     $category_ids = json_decode($items->category_ids);
							     foreach($category_ids as $dd){ $catee = (array)$dd; $categoryidd = $catee['id'];  } 
							     $category_name = DB::table('trading_categories')->where('id',$categoryidd)->first();
							     $city_name = DB::table('cities')->where('id',$items->location)->first();
							     
							     $state_name = DB::table('states')->where('id',$city_name->state_id)->first();
							     
							     $seller_info = DB::table('users')->where('id',$items->seller_id)->first();
							     
							     
							     @endphp
							    <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
								<div class="card aos flex-fill" data-aos="fade-up">
									<div class="blog-widget">
										<div class="blog-img">
											<a href="{{ route('details-item-view',['slug'=>$items->slug])}}"> <img style="height:208px;" src="{{\App\CPU\ProductManager::trading_product_image_path('thumbnail')}}/{{$items->thumbnail}}" class="img-fluid" alt="blog-img"> </a>
											<div class="fav-item">
												<span class="btn btn-success" >Latest Ad</span>
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
														<a href="javascript:void(0)"><span> <i class="fa-regular fa-circle-stop"></i>{{$category_name->name}}</span></a>
													</div>
													<div class="blog-author text-end">
														<span> <i class="feather-eye"></i> 1K </span>
													</div>
												</div>
												<h6><a href="{{ route('details-item-view',['slug'=>$items->slug])}}">{{$items->name}}</a></h6>
												<div class="blog-location-details">
													<div class="location-info">
														<i class="feather-map-pin"></i> {{$city_name->name}}, {{$state_name->name}}
													</div>
													<div class="location-info">
														<i class="fa-solid fa-calendar-days"></i> {{date('d M, Y', strtotime($items->created_at))}}
													</div>
												</div>
												<div class="amount-details">
													<div class="amount">
														<span class="validrate">{{\App\CPU\Helpers::currency_converter($items->unit_price)}}</span>
														<!--<span>$450</span>-->
													</div>
													
													<div class="ratings">
														<a href="{{ route('details-item-view',['slug'=>$items->slug])}}"><span>View More</span></a>
													</div>
													<!--<div class="ratings">
														<span>4.7</span> (50)
													</div>-->
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
			</section>