@extends('web-views.animal-trading.app')

@section('title', 'Search By Category | Silo Fortune')


@section('content')

<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Search Animal Near By You</h2>
                    
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
                        <option>Computer</option>
                        <option>Electronics</option>
                        <option>Car wash</option>
                     </select>
                  </div>
                  <div class="filter-content looking-input form-group input-placeholder">
                     <div class="group-img">
                        <input type="text" class="form-control" placeholder="Where to look?">
                        <i class="feather-map-pin"></i>
                     </div>
                  </div>
                  <div class="filter-content form-group region">
                     <select class="form-control select region-select">
                        <option value>Region</option>
                        <option>Canada</option>
                        <option>USA</option>
                        <option>india</option>
                     </select>
                  </div>
                  <div class="filter-content form-group amenities">
                     <h4> Amenities</h4>
                     <ul>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="wireless-internet">
                           <span class="checkmark"></span> Wireless Internet
                           </label>
                        </li>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="accept-credit-card">
                           <span class="checkmark"></span> Accepts Credit Cards
                           </label>
                        </li>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="Coupouns">
                           <span class="checkmark"></span> Coupouns
                           </label>
                        </li>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="parking-street">
                           <span class="checkmark"></span> Parking Street
                           </label>
                        </li>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="bike-parking">
                           <span class="checkmark"></span> Bike Parking
                           </label>
                        </li>
                        <li>
                           <label class="custom_check">
                           <input type="checkbox" name="Smoking-Allowed">
                           <span class="checkmark"></span> Smoking Allowed
                           </label>
                        </li>
                     </ul>
                  </div>
                  <div class="filter-content form-group amenities radius">
                     <div class="slidecontainer">
                        <div class="slider-info">
                           <h4> Radius</h4>
                           <div class="demo"><span>50</span> Radius</div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="filter-range">
                           <input type="text" class="input-range">
                        </div>
                     </div>
                  </div>
                  <div class="filter-content amenities mb-0">
                     <h4> Price Range</h4>
                     <div class="form-group mb-0">
                        <input type="text" class="form-control" placeholder="Min">
                        <input type="text" class="form-control me-0" placeholder="Max">
                     </div>
                     <div class="search-btn">
                        <button class="btn btn-primary" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        <button class="btn btn-reset mb-0" type="submit"> <i class="fas fa-light fa-arrow-rotate-right"></i> Reset Filters</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-lg-8">
         <div class="row sorting-div">
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
         </div>
         <div class="blog-listview">
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="service-details.html">
                     <img src="{{ asset('public/assets/animal-trading/assets//img/blog/bloglistimg-1.jpg') }}" class="img-fluid" alt="blog-img">
                     </a>
                     <div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> Construction</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('public/assets/animal-trading/assets//img/profiles/avatar-01.jpg') }}" alt="author">
                              </div>
                              <a href="javascript:void(0);">John Doe</a>
                           </div>
                        </div>
                        <h6><a href="service-details.html">Villa 457 sq.m. In Benidorm Fully Qquipped House</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> Los Angeles
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> +44 6633 6526
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 4000
                           </div>
                        </div>
                        <p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">$350</span>
                              <span>$450</span>
                           </div>
                           <a href="service-details.html">View details</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="service-details.html">
                     <img src="{{asset('public/assets/animal-trading/assets//img/blog/bloglistimg-2.jpg') }}" class="img-fluid" alt="blog-img">
                     </a>
                     <div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> Jobs</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('public/assets/animal-trading/assets//img/profiles/avatar-10.jpg') }}" alt="author">
                              </div>
                              <a href="javascript:void(0);">Orlando Diggs</a>
                           </div>
                        </div>
                        <h6><a href="service-details.html">CDL A OTR Compnay Driver Job-N</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> Los Angeles
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> +44 6633 6526
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 4000
                           </div>
                        </div>
                        <p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">$350</span>
                              <span>$450</span>
                           </div>
                           <a href="service-details.html">View details</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="service-details.html">
                     <img src="{{asset('public/assets/animal-trading/assets//img/blog/bloglistimg-3.jpg') }}" class="img-fluid" alt="blog-img">
                     </a>
                     <div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> Electronics</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('public/assets/animal-trading/assets//img/profiles/avatar-04.jpg') }}" alt="author">
                              </div>
                              <a href="javascript:void(0);">Kate Morrison</a>
                           </div>
                        </div>
                        <h6><a href="service-details.html">HP Gaming 15.6 Touchscreen 12G</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> Los Angeles
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> +44 6633 6526
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 4000
                           </div>
                        </div>
                        <p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">$350</span>
                              <span>$450</span>
                           </div>
                           <a href="service-details.html">View details</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="service-details.html">
                     <img src="{{asset('public/assets/animal-trading/assets//img/blog/bloglistimg-4.jpg') }}" class="img-fluid" alt="blog-img">
                     </a>
                     <div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> Vehicles</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('public/assets/animal-trading/assets//img/profiles/avatar-06.jpg') }}" alt="author">
                              </div>
                              <a href="javascript:void(0);">Koray Okumus</a>
                           </div>
                        </div>
                        <h6><a href="service-details.html">2022 Audi R8 GT Spyder Convertible</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> Los Angeles
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> +44 6633 6526
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 4000
                           </div>
                        </div>
                        <p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">$350</span>
                              <span>$450</span>
                           </div>
                           <a href="service-details.html">View details</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="service-details.html">
                     <img src="{{asset('public/assets/animal-trading/assets//img/blog/bloglistimg-5.jpg') }}" class="img-fluid" alt="blog-img">
                     </a>
                     <div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> Vehicles</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('public/assets/animal-trading/assets//img/profiles/avatar-05.jpg') }}" alt="author">
                              </div>
                              <a href="javascript:void(0);">Ava Wright</a>
                           </div>
                        </div>
                        <h6><a href="service-details.html">2017 Gulfsteam Ameri-lite</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> Los Angeles
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> +44 6633 6526
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 4000
                           </div>
                        </div>
                        <p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">$350</span>
                              <span>$450</span>
                           </div>
                           <a href="service-details.html">View details</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="service-details.html">
                     <img src="{{asset('public/assets/animal-trading/assets//img/blog/bloglistimg-6.jpg') }}" class="img-fluid" alt="blog-img">
                     </a>
                     <div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> Electronics</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('public/assets/animal-trading/assets//img/profiles/avatar-08.jpg') }}" alt="author">
                              </div>
                              <a href="javascript:void(0);">Eve Leroy</a>
                           </div>
                        </div>
                        <h6><a href="service-details.html">Fashion Luxury Men Date</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> Los Angeles
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> +44 6633 6526
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 4000
                           </div>
                        </div>
                        <p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">$350</span>
                              <span>$450</span>
                           </div>
                           <a href="service-details.html">View details</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="service-details.html">
                     <img src="{{asset('public/assets/animal-trading/assets//img/blog/bloglistimg-7.jpg') }}" class="img-fluid" alt="blog-img">
                     </a>
                     <div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> Electronics</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('public/assets/animal-trading/assets//img/profiles/avatar-09.jpg') }}" alt="author">
                              </div>
                              <a href="javascript:void(0);">Zahir Mays</a>
                           </div>
                        </div>
                        <h6><a href="service-details.html">Apple iphone6 16GB 4G LTE</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> Los Angeles
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> +44 6633 6526
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 4000
                           </div>
                        </div>
                        <p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">$350</span>
                              <span>$450</span>
                           </div>
                           <a href="service-details.html">View details</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="blog-widget">
                  <div class="blog-img">
                     <a href="service-details.html">
                     <img src="{{asset('public/assets/animal-trading/assets//img/blog/bloglistimg-8.jpg') }}" class="img-fluid" alt="blog-img">
                     </a>
                     <div class="fav-item">
                        <span class="Featured-text">Featured</span>
                        <a href="javascript:void(0)" class="fav-icon">
                        <i class="feather-heart"></i>
                        </a>
                     </div>
                  </div>
                  <div class="bloglist-content">
                     <div class="card-body">
                        <div class="blogfeaturelink">
                           <div class="blog-features">
                              <a href="javascript:void(0);"><span> <i class="fa-regular fa-circle-stop"></i> Electronics</span></a>
                           </div>
                           <div class="blog-author">
                              <div class="blog-author-img">
                                 <img src="{{asset('public/assets/animal-trading/assets//img/profiles/avatar-10.jpg') }}" alt="author">
                              </div>
                              <a href="javascript:void(0);">Zahir Mays</a>
                           </div>
                        </div>
                        <h6><a href="service-details.html">Customized Apple iMac 21.5" All-In</a></h6>
                        <div class="blog-location-details">
                           <div class="location-info">
                              <i class="feather-map-pin"></i> Los Angeles
                           </div>
                           <div class="location-info">
                              <i class="feather-phone-call"></i> +44 6633 6526
                           </div>
                           <div class="location-info">
                              <i class="feather-eye"></i> 4000
                           </div>
                        </div>
                        <p class="ratings">
                           <span>4.0</span> ( 50 Reviews )
                        </p>
                        <div class="amount-details">
                           <div class="amount">
                              <span class="validrate">$350</span>
                              <span>$450</span>
                           </div>
                           <a href="service-details.html">View details</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="blog-pagination">
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
            </div>
         </div>
      </div>
   </div>
</div>
</div>

@endsection