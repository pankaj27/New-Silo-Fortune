@extends('web-views.animal-trading.app')
@php 
use Illuminate\Support\Facades\DB;

@endphp

@section('title', 'View Latest Ads | Silo Fortune')


@section('content')

<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Latest Ads</h2>
                    
            </div>
        </div>
    </div>
</div>

<div class="dashboard-content">
   <div class="container">
      <div class="bookmarks-content grid-view featured-slider">
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
            
            <div class="col-lg-4 col-md-4 col-sm-6 ">
               <div class="card aos aos-init aos-animate" data-aos="fade-up">
                  <div class="blog-widget">
                     <div class="blog-img">
                        <a href="{{ route('details-item-view',['slug'=>$items->slug])}}"> <img style="height:208px;" src="{{\App\CPU\ProductManager::trading_product_image_path('thumbnail')}}/{{$items->thumbnail}}" class="img-fluid" alt="blog-img"> </a>
											
                        
                        <div class="fav-item">
                           <span class="Featured-text">Latest Ad</span>
                           <a href="javascript:void(0)" class="fav-icon">
                           <i class="feather-heart"></i>
                           </a>
                        </div>
                     </div>
                     <div class="bloglist-content">
                        <div class="card-body">
                           <div class="blogfeaturelink">
                              <div class="grid-author">
                                 <img src="{{asset('storage/app/public/profile/'.$seller_info->image)}}"
                                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" >
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
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            @endforeach
            
            
            
            <!--<div class="blog-pagination">
               <nav>
                  <ul class="pagination">
                     <li class="page-item previtem">
                        <a class="page-link" href="#"><i class="fas fa-regular fa-arrow-left"></i> Prev</a>
                     </li>
                     <li class="justify-content-center pagination-center">
                        <div class="pagelink">
                           <ul>
                              <li class="page-item">
                                 <a class="page-link" href="#">1</a>
                              </li>
                              <li class="page-item active">
                                 <a class="page-link" href="#">2 <span class="visually-hidden">(current)</span></a>
                              </li>
                              <li class="page-item">
                                 <a class="page-link" href="#">3</a>
                              </li>
                              <li class="page-item">
                                 <a class="page-link" href="#">...</a>
                              </li>
                              <li class="page-item">
                                 <a class="page-link" href="#">14</a>
                              </li>
                           </ul>
                        </div>
                     </li>
                     <li class="page-item nextlink">
                        <a class="page-link" href="#">Next <i class="fas fa-regular fa-arrow-right"></i></a>
                     </li>
                  </ul>
               </nav>
            </div>-->
         </div>
      </div>
   </div>
</div>
            

@endsection