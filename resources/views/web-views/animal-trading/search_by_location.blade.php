@extends('web-views.animal-trading.app')

@section('title', 'Search By Location | Silo Fortune')

@php 
    use Illuminate\Support\Facades\DB; 
    $location = DB::table('trading_products')->select('location')->where('status',1)->distinct()->get();
    $category = DB::table('trading_categories')->get();
    $breed = DB::table('breeds')->get();
    if($location_id!=''){
        $city_na = DB::table('cities')->where('id',$location_id)->first();
    }else{ 
        $city_na = 'By You';
    }
				
    
    
@endphp

@section('content')

<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Search Animal Near {{$city_na->name}}</h2>
                    
            </div>
        </div>
    </div>
</div>

<div class="list-content">
<div class="container">
   <div class="row">
      <div class="col-lg-4 theiaStickySidebar">
         <div class="listings-sidebar">
            <div class="card">
               <h4><img src="{{ asset('public/assets/animal-trading/assets//img/details-icon.svg') }}" alt="details-icon"> Filter</h4>
               <form>
                  <div class="filter-content looking-input form-group">
                     <input type="text" class="form-control" placeholder="What are you looking for?">
                  </div>
                  <div class="filter-content form-group">
                     <select class="form-control select category-select">
                        <option value>Choose Category</option>
                        @foreach($category as $catnam)
                            <option value="{{$catnam->id}}">{{$catnam->name}}</option>
                        @endforeach
                        
                     </select>
                  </div>
                  
                  <div class="filter-content form-group">
                     <select class="form-control select category-select">
                        <option value>Choose Breed</option>
                        @foreach($breed as $catnam)
                            <option value="{{$catnam->id}}">{{$catnam->name}}</option>
                        @endforeach
                        
                     </select>
                  </div>
                  <div class="filter-content looking-input form-group input-placeholder">
                     <div class="group-img">
                        <input type="text" class="form-control" placeholder="Where to look?">
                        <i class="feather-map-pin"></i>
                     </div>
                  </div>
                  
                  <div class="filter-content form-group amenities">
                     <h4> Milking/Day (Ltre)</h4>
                     <ul>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="milking_perday" value="1">
                           <span class="checkmark"></span> 3-5 Ltr
                           </label>
                        </li>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="milking_perday" value="2">
                           <span class="checkmark"></span> 6-10 Ltr
                           </label>
                        </li>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="milking_perday" value="3">
                           <span class="checkmark"></span> 11-15 Ltr
                           </label>
                        </li>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="milking_perday" value="4">
                           <span class="checkmark"></span> 16-20 Ltr
                           </label>
                        </li>
                        
                     </ul>
                  </div>
                  
                  <div class="filter-content amenities mb-0">
                     <h4> Price Range</h4>
                     <div class="form-group mb-0">
                        <input type="text" class="form-control" placeholder="Min">
                        <input type="text" class="form-control me-0" placeholder="Max">
                     </div>
                     <div class="search-btn">
                        <button class="btn btn-primary" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        <button class="btn btn-reset mb-0" type="reset"> <i class="fas fa-light fa-arrow-rotate-right"></i> Reset Filters</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-lg-8">
         <!--<div class="row sorting-div">
            <div class="col-lg-4 col-sm-4 align-items-center d-flex">
               <div class="count-search">
                  <p>Showing <span>1-8</span> of 10 Results</p>
               </div>
            </div>
            <div class="col-lg-8 col-sm-8  align-items-center">
               <div class="sortbyset">
                  <span class="sortbytitle">Sort by</span>
                  <div class="sorting-select">
                     <select class="form-control select">
                        <option>Default</option>
                        <option>Price Low to High</option>
                        <option>Price High to Low</option>
                     </select>
                  </div>
               </div>
               <div class="grid-listview">
                  <ul>
                     <li>
                        <a href="listing-list-sidebar.html" class="active">
                        <i class="feather-list"></i>
                        </a>
                     </li>
                     <li>
                        <a href="listing-grid-sidebar.html">
                        <i class="feather-grid"></i>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>-->
         <div class="blog-listview">
             @foreach($search_by_location as $items)
             @php
                $category_ids = json_decode($items->category_ids);
				foreach($category_ids as $dd){ $catee = (array)$dd; $categoryidd = $catee['id'];  } 
				$category_name = DB::table('trading_categories')->where('id',$categoryidd)->first();
				$city_name = DB::table('cities')->where('id',$items->location)->first();
							     
				$state_name = DB::table('states')->where('id',$city_name->state_id)->first();
							     
				$seller_info = DB::table('users')->where('id',$items->seller_id)->first();
             @endphp
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="{{ route('details-item-view',['slug'=>$items->slug])}}"> <img style="height:208px;" src="{{\App\CPU\ProductManager::trading_product_image_path('thumbnail')}}/{{$items->thumbnail}}" class="img-fluid" alt="blog-img"> </a>
										
                     <!--<div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>-->
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> {{$category_name->name}}</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('storage/app/public/profile/'.$seller_info->image)}}"
                                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"  alt="author">
                              </div>
                              <a href="javascript:void(0);">{{$seller_info->name}}</a>
                           </div>
                        </div>
                        <h6><a href="{{ route('details-item-view',['slug'=>$items->slug])}}">{{$items->name}}</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> {{$city_name->name}}, {{$state_name->name}}
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> {{$seller_info->phone}}
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 1K
                           </div>
                        </div>
                        <!---<p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>-->
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">{{\App\CPU\Helpers::currency_converter($items->unit_price)}}</span>
                              <!--<span>$450</span>-->
                           </div>
                           <a href="{{ route('details-item-view',['slug'=>$items->slug])}}">View details</a>
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
</div>

@endsection