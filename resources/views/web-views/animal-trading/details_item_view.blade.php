@extends('web-views.animal-trading.app')
<?php use Illuminate\Support\Facades\DB; ?>
@section('title', 'Details Items | Silo Fortune')


@section('content')

<div class="bannergallery-section">
    <div class="gallery-slider d-flex">
        <?php if(count(json_decode($details_view[0]->images)) <4){ ?>
             <div class="gallery-widget">
                    <a href="{{asset('storage/app/public/trading-product/thumbnail/<?php echo $details_view[0]->thumbnail ; ?>')}}" data-fancybox="gallery1">
                        <img class="img-fluid" alt="Image" src="{{asset('storage/app/public/trading-product/thumbnail/<?php echo $details_view[0]->thumbnail ; ?>')}}" style="width:480px; height:600px;">
                    </a>
                </div>
                
         <?php } ?>
        @if($details_view[0]->images!=null)
            <?php $ii = 1; ?>
            @foreach (json_decode($details_view[0]->images) as $key => $photo)
            <?php $ii++; ?>
                <div class="gallery-widget">
                    <a href="{{asset("storage/app/public/trading-product/$photo")}}" data-fancybox="gallery1">
                        <img class="img-fluid" alt="Image" src="{{asset("storage/app/public/trading-product/$photo")}}" style="width:480px; height:600px;">
                    </a>
                </div>
                
           @endforeach
       @endif
       
      <?php if($ii<4){
          $kkoo = 4 - $ii;
         
      
      ?>
       <?php  for($kl=0;$kl<$kkoo;$kl++){ ?>
       
                <div class="gallery-widget">
                    <a href="{{asset('storage/app/public/trading-product/thumbnail/'.$details_view[0]->thumbnail)}}" data-fancybox="gallery1">
                        <img class="img-fluid" alt="Image" src="{{asset('storage/app/public/trading-product/thumbnail/'.$details_view[0]->thumbnail)}}" style="width:480px; height:600px;">
                    </a>
                </div>
           
           
       <?php 
           
                }
            } 
        
        ?>
       
       
        
    </div>
</div>

<section class="details-description">
	<div class="container">
		<div class="about-details">
			<div class="about-headings">
				<div class="author-img">
					<img src="{{asset('storage/app/public/trading-product/thumbnail/'.$details_view[0]->thumbnail)}}" alt="authorimg">
				</div>
				<div class="authordetails">
					<h5>{{$details_view[0]->name}}</h5>
					<p>Silo Fortune Trading Product</p>
					<div class="rating">
						<i class="fas fa-star filled"></i>
						<i class="fas fa-star filled"></i>
						<i class="fas fa-star filled"></i>
						<i class="fas fa-star filled"></i>
						<i class="fa-regular fa-star rating-color"></i>
						<span class="d-inline-block average-rating"> 4.5 </span>
					</div>
				</div>
			</div>
			<div class="rate-details">
				<h2>{{\App\CPU\Helpers::currency_converter($details_view[0]->unit_price)}}</h2>
				<p>Fixed</p>
			</div>
		</div>
		<div class="descriptionlinks">
			<div class="row">
				<div class="col-lg-9">
					<ul>
						<li><a href="javascript:void(0);"><i class="feather-map"></i> Location</a></li>
						<li><a href="javascript:void(0);"><i class="feather-share-2"></i> share</a></li>
						<!--<li><a href="javascript:void(0);"><i class="fa-regular fa-comment-dots"></i> Write a review</a></li>
						<li><a href="javascript:void(0);"><i class="feather-flag"></i> report</a></li>-->
						<li><a href="javascript:void(0);"><i class="feather-heart"></i> Save</a></li>
					</ul>
				</div>
				<div class="col-lg-3">
					<div class="callnow">
						<a href="tel:{{$details_view[0]->seller_contact_no}}" data-toggle="modal" data-target="#myModal"> <i class="feather-phone-call"></i> Call Now</a>
						
						  <div class="modal" id="myModal">
                            <div class="modal-dialog">
                              <div class="modal-content">
                              
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Modal Heading</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                  Modal body..
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                                
                              </div>
                            </div>
                          </div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>


<div class="details-main-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="card ">
					<div class="card-header">
						<span class="bar-icon">
							<span></span>
							<span></span>
							<span></span>
						</span>
						<h4>Description</h4>
					</div>
					<div class="card-body">
						{!! $details_view[0]->details !!}
					</div>
				</div>

				
				<div class="card gallery-section ">
					<div class="card-header ">
						<img src="{{ asset('public/assets/animal-trading/assets/img/galleryicon.svg') }}" alt="gallery">
						<h4>Gallery</h4>
					</div>
					<div class="card-body">
						<div class="gallery-content">
							<div class="row">
							    @foreach (json_decode($details_view[0]->images) as $key => $photo)
								<div class="col-lg-3 col-md-3 col-sm-3">
									<div class="gallery-widget" style="width:211px;height:220px;">
										<a href="{{asset("storage/app/public/trading-product/$photo")}}" data-fancybox="gallery1">
											<img class="img-fluid" alt="Image" src="{{asset("storage/app/public/trading-product/$photo")}}" style="width:211px;height:220px;" >
										</a>
									</div>
								</div>
								@endforeach
								
							</div>
						</div>
					</div>
				</div>
                
                <div class="card">
						<h4><img src="{{ asset('public/assets/animal-trading/assets/img/breifcase.svg') }}" alt> Seller Info</h4>
						<div class="map-details">
							<div class="map-frame">
							    <?php $address = DB::table('shipping_addresses')->where('id',$details_view[0]->seller_address)->get(); 
							    
							        $addrr = str_replace(" ","%20",$address[0]->address);
							    ?>
								
                                <iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=450&amp;hl=en&amp;q={{$addrr}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
							</div>
							<ul class="info-list">
								<li><i class="feather-map-pin"></i> {{ $address[0]->address }} <br></li>
								<li><i class="feather-phone-call"></i> {{ $details_view[0]->seller_contact_no }}<br></li>
								<li class="socialicons pb-0">
									<a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
									<a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
									<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
									<a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
								</li>
							</ul>
						</div>
					</div>

				


				

			</div>
			<div class="col-lg-3 theiaStickySidebar">
				<div class="rightsidebar">
					<div class="card">
						<h4><img src="{{ asset('public/assets/animal-trading/assets/img/details-icon.svg') }}" alt="details-icon"> Details</h4>
						<ul>
							<li>Category <span>Sheep</span></li>
							<li>Breed <span>Holestin </span></li>
							<li>Location <span>Karnataka, India</span></li>
							<li>Is Pregnent <span>Yes</span></li>
							<li>Milking/Day <span>4</span></li>
							<li>Lactation No.<span>8</span></li>
							
						</ul>
					</div>
					
					<div class="card">
						<h4><img src="{{ asset('public/assets/animal-trading/assets/img/statistic-icon.svg') }}" alt="location"> Statisfic</h4>
						<ul class="statistics-list">
							<li>
								<div class="statistic-details"><span class="icons"><i class="fa-regular fa-eye"></i></span>
									Views </div><span class="text-end"> 0</span>
							</li>
							
							<li>
								<div class="statistic-details"><span class="icons"><i class="feather-heart"></i></span>
									Favuorites </div><span class="text-end"> 0</span>
							</li>
							<li class="mb-0">
								<div class="statistic-details"><span class="icons"><i class="feather-share-2"></i></span>
									Shares </div><span class="text-end"> 0</span>
							</li>
						</ul>
					</div>
					<?php $seller_details = DB::table('users')->where('id',$details_view[0]->seller_id)->get(); ?>
					<div class="card">
						<h4> <i class="feather-user"></i> Published By</h4>
						<div class="sidebarauthor-details align-items-center">
							<div class="sideauthor-img">
								<img src="{{asset('storage/app/public/profile/'.$seller_details[0]->image)}}" onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" alt="author">
							</div>
							<div class="sideauthor-info">
								<p class="authorname">Johnson</p>
								<p>Member since {{ date('M d, Y', strtotime($seller_details[0]->created_at))}}</p>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>



@endsection